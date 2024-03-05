<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use SoftDeletes, HasUuids, HasFactory;

    //deberia trabajar con enumeraciones
    public static array $ESTADOS_HISTORICOS = ['CANCELADO','ENTREGADO','ARCHIVADO'];
    public static array $ESTADOS_ACTIVOS = ['CREADO','COMPLETADO','PAGADO','ENVIADO','RECLAMADO','ERRONEO'];
    public static array $ESTADOS_POSIBLES = [
        'CREADO','COMPLETADO','PAGADO','ENVIADO','RECLAMADO','ERRONEO',
        'CANCELADO','ENTREGADO','ARCHIVADO',
    ];


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

    public function lineasPedido(): HasMany
    {
        return $this->hasMany(LineaPedido::class);
    }

    public function scopeActivos(Builder $query)
    {
        return $query->where('estado','in',Pedido::$ESTADOS_ACTIVOS);
    }
    public function scopeHistoricos(Builder $query)
    {
        return $query->where('estado','in',Pedido::$ESTADOS_HISTORICOS);
    }


    public function validarLineas(): bool
    {
        $pedidos = $this->lineasPedido();

        $validos = true;

        foreach ($pedidos as $pedido)
        {
            $validos = $validos && $pedido->validar();
        }

        return $validos;
    }

    public function actualizarStockLineas(): bool
    {
        $pedidos = $this->lineasPedido();

        $validos = true;

        foreach ($pedidos as $pedido)
        {
            $validos = $validos && $pedido->actualizarStock();
        }

        return $validos;
    }
}
