<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DireccionPersonal extends Model
{
    use SoftDeletes, HasUuids, HasFactory;

    protected $fillable = [
        'direccion',
        'nombre',
        'apellido',
    ];

    protected $casts = [
        'direccion' => 'array',
    ];

    protected function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
