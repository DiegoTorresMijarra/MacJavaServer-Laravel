<?php

namespace App\Http\Resources;

use App\Models\Pedido;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Crypt;

/** @mixin Pedido */
class PedidoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'created_at' => $this->created_at,
            'id' => $this->id,

            'estado' => $this->estado,

            'precioTotal' => $this->precioTotal,
            'stockTotal' => $this->stockTotal,

            'numero_tarjeta' => '****-****-****-'.substr($this->numero_tarjeta,-4),
            //'cvc' => Crypt::decrypt($this->cvc,false),

            'direccionPersonal' => new DireccionPersonalResource($this->direccionPersonal()),
            'lineaPedidos' => LineaPedidoResource::collection($this->lineasPedido()),

            'usuario' => $this->user()->get(['id','email'])
        ];
    }
    public function data()
    {
        try {
            return [
                'created_at' => $this->created_at,
                'id' => $this->id,

                'estado' => $this->estado,

                'precioTotal' => $this->precioTotal,
                'stockTotal' => $this->stockTotal,

                'numero_tarjeta' => '****-****-****-'.substr($this->numero_tarjeta,-4),
                //'cvc' => Crypt::decrypt($this->cvc,false),

                'direccionPersonal' => new DireccionPersonalResource($this->direccionPersonal()->first()),
                'lineaPedidos' => LineaPedidoResource::collection($this->lineasPedido()->get()),

                'usuario' => $this->user()->get(['id','email'])
            ];
        }catch (DecryptException $e) {
            throw new AuthorizationException($e->getMessage().$e->getLine());
        }
    }
}
