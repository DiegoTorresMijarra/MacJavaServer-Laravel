<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
        return [[],[]];
        //return $this->hasMany(Pedidos::class);
    }
    public function empleado(): ?HasOne
    {
        if ($this->rol && $this->rol!=='USER')
        {
            return $this->hasOne(Trabajador::class);
        }
        return null; //exception?
    }
}
