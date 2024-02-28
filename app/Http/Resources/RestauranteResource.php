<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Restaurante */
class RestauranteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'id' => $this->id,
            'nombre' => $this->nombre,
            'capacidad' => $this->capacidad,

            'direccion' => new DireccionResource($this->whenLoaded('direccion')),
        ];
    }
}
