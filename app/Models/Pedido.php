<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use SoftDeletes, HasUuids, HasFactory;

    protected $fillable = [
        'estado',
        'precioTotal',
        'stockTotal',
    ];

    protected function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function direccionPersonal(): BelongsTo
    {
        return $this->belongsTo(DireccionPersonal::class);
    }
}
