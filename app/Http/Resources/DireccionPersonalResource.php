<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\DireccionPersonal */
class DireccionPersonalResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'id' => $this->id,
            'direccion' => $this->direccion,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
        ];
    }
}
