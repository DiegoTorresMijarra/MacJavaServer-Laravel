<?php

namespace App\Http\Resources;

use App\Models\LineaPedido;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin LineaPedido */
class LineaPedidoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
            'id' => $this->id,
            'precio' => $this->precio,
            'stock' => $this->stock,

            'producto' => $this->producto()->get(['id','nombre','imagen']),
           // 'producto' => new ProductoResource($this->whenLoaded('producto')),
           // 'pedido' => new PedidoResource($this->whenLoaded('pedido')),
        ];
    }
}
