<?php

namespace App\Http\Requests;

use App\Http\Controllers\CarritoController;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Producto;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class LineaPedidoProvisionalRequest extends FormRequest
{
    public function rules(): array
    {
        $producto = Producto::find($this->input('producto_id'));

        $stockSesion = CarritoController::getStockSession($this->input('producto_id'));

        if(!$producto) //pero esto podriamos notificarlo, porq puede ser signo de un ataque
        {
            throw new BadRequestException('El producto no existe');
        }
        return [
            'precio' => ['required', 'numeric', 'gte:'. $producto->precio, 'lte:' . $producto->precio],
            'stock' => ['required', 'integer', 'gte:1', 'lte:' . $producto->stock-$stockSesion],

            'producto_id' => ['required', 'integer', 'exists:productos,id'],
        ];
    }
}
