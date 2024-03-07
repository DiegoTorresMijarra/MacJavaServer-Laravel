<?php

namespace App\Http\Requests;

use App\Models\Producto;
use Illuminate\Foundation\Http\FormRequest;

class LineaPedidoRequest extends FormRequest
{
    public function rules(): array
    {
        $producto = Producto::find($this->input('producto_id'));

        return [
            'precio' => ['required', 'numeric', 'gte:'. $producto->precio, 'lte:' . $producto->precio],
            'stock' => ['required', 'integer','gte:1', 'lte:' . $producto->stock],

            'producto_id' => ['required', 'integer','exists:productos,id'],
            'pedido_id' => ['nullable', 'uuid', 'exists:pedidos,id'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
    public function validar()
    {
        $this->validate($this->rules());
    }
}
