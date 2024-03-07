<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Trabajador extends Model
{
    use SoftDeletes, HasFactory;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'trabajadores';

    protected $fillable = [
        'nombre',
        'apellidos',
        'nomina',
        'puesto',
    ];

    protected function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->whereRaw('LOWER(nombre) LIKE ?', ["%" . strtolower($search) . "%"]);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($trabajador) {
            $trabajador->id = Str::uuid();
        });
    }
}
