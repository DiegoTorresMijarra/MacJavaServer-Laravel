<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Dotenv\Util\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    public static array $ROLES_ENUM=['USER', 'EMPLEADO', 'ADMIN'];

    public static string $AVATAR_DEFAULT='images/user.png';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rol',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function direcciones(): ?HasMany
    {
        return $this->hasMany(DireccionPersonal::class);
    }
    public function pedidos()
    {
return $this->hasMany(Pedidos::class);
    }
    public function empleado(): ?HasOne
    {
        if ($this->rol && $this->rol!=='USER')
        {
            return $this->hasOne(Trabajador::class);
        }
        return null; //exception?
    }

    public function scopeRol($query, String $rol)
    {
        if (User::$ROLES_ENUM->contains($rol)) //tb podria lanzar exception o cualquier logica
        {
            return $query->whereRaw('LOWER(rol) LIKE ?', ["%" . strtolower($rol) . "%"]);
        }
        return $query;
    }
    public function scopeEmpleado($query, bool $empleado)
    {
        $roles = $empleado ? ['EMPLEADO', 'ADMIN'] : ['USER'];
        $query->whereRaw('LOWER(rol) IN (?)', [implode(',', $roles)]);

        return $query;
    }
    public function scopeEmail($query, $email)
    {
        return $query->whereRaw('LOWER(email) LIKE ?', ["%" . strtolower($email) . "%"]);
    }

    /**
     * elimina las imagenes q no son por defecto, y actualiza a ese valor la del usuario pasado
     * @return void
     */
    public function destroyImage(): void
    {
        if ($this->avatar != User::$AVATAR_DEFAULT && Storage::disk($this->avatar)) {
            // Eliminamos la imagen
            Storage::delete($this->avatar);

            $this->avatar = User::$AVATAR_DEFAULT;
            $this->save();
        }
    }
}
