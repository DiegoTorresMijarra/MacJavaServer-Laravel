<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class LineaPedido extends Model
{
    use SoftDeletes, HasUuids, HasFactory;

    protected $table = 'lineas_pedidos';

    protected $fillable = [
        'precio',
        'stock',

        'producto_id',
        'pedido_id',
    ];

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }

    public function pedido(): BelongsTo
    {
        return $this->belongsTo(Pedido::class);
    }

    public function validarLinea(): bool
    {
        $producto = $this->producto()->first();

        if($producto->precio==$this->precio && $producto->stock>=$this->stock)
        {
            return true;
        }
        return false; //exception
    }

    public function actualizarStock(): bool
    {
        if ($this->validarLinea())
        {
            $producto = $this->producto()->first();
            $producto->stock -= $this->stock;
            $producto->save();

            return true;
        }
        return false;
    }
}
