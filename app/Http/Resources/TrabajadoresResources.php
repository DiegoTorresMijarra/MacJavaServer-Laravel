<?php

namespace App\Http\Resources;

use App\Models\Trabajadores;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Trabajadores */
class TrabajadoresResources extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'id' => $this->id,
            'userId' => $this->userId,
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'nomina' => $this->nomina,
            'puesto' => $this->puesto,
        ];
    }
}
