<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trabajador extends Model
{
    use SoftDeletes, HasFactory;

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
}
