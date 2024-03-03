<?php

namespace App\Http\Resources;

use App\Models\DireccionPersonal;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin DireccionPersonal */
class DireccionPersonalResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'id' => $this->id,
            'pais' => $this->pais,
            'provincia' => $this->provincia,
            'municipio' => $this->municipio,
            'codigoPostal' => $this->codigoPostal,
            'calle' => $this->calle,
            'numero' => $this->numero,
            'portal' => $this->portal,
            'infoAdicional' => $this->infoAdicional,
            'piso' => $this->piso,
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,

            'usuario' => $this->user()->get(['id','name']),
            // 'pedidos' => $this->pedidos()->get(['id']),
        ];
    }
}
