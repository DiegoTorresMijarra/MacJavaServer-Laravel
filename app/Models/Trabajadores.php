<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajadores extends Model
{
    use HasFactory;
    public static string $IMAGE_DEFAULT = 'https://placehold.jp/150x150.png';
    protected $fillable = [
        'id',
        'userId',
        'nombre',
        'apellidos',
        'nomina',
        'imagen',
        'puesto',

    ];

    protected $casts = [
        'id' => 'string',
        'userId' => 'string',
    ];

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->where('nombre', 'like', '%' . $search . '%')
                ->orWhere('imagen', 'like', '%' . $search . '%')
                ->orWhere('apellidos', 'like', '%' . $search . '%')
                ->orWhere('puesto', 'like', '%' . $search . '%');
    }
}
