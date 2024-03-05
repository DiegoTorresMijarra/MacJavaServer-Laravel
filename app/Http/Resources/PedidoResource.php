<?php

namespace App\Http\Resources;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Pedido */
class PedidoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
           // 'created_at' => $this->created_at,
           // 'updated_at' => $this->updated_at,
            'id' => $this->id,
            'estado' => $this->estado,
            'precioTotal' => $this->precioTotal,
            'stockTotal' => $this->stockTotal,

            'direccionPersonal' => new DireccionPersonalResource($this->whenLoaded('direccionPersonal')),
            'lineaPedidos' => LineaPedidoResource::collection($this->lineasPedido()),
        ];
    }
}
