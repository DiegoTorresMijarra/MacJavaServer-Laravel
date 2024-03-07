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

    protected $table = 'direcciones_personales';

    protected $fillable = [
        'pais',
        'provincia',
        'municipio',
        'codigoPostal',
        'calle',
        'numero',
        'portal',
        'infoAdicional',
        'piso',
        'nombre',
        'apellidos',

        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pedidos()
    {
       return $this->hasMany(Pedido::class);
    }
}
