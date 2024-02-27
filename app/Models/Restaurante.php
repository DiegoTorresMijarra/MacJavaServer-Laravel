<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurante extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'direccion',
        'nombre',
        'capacidad',
    ];

    protected $casts = [
        'direccion' => 'array',
    ];
}
