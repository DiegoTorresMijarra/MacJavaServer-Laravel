<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurante extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'nombre',
        'capacidad',
    ];

    protected function direccion(): BelongsTo
    {
        return $this->belongsTo(Direccion::class);
    }
}
