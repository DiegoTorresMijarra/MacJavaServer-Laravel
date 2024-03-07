<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Direccion */
class DireccionResource extends JsonResource
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
        ];
    }
}
