<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DireccionPersonalRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'pais' => ['required'],
            'provincia' => ['required'],
            'municipio' => ['required'],
            'codigoPostal' => ['required'],
            'calle' => ['required'],
            'numero' => ['required'],
            'portal' => ['nullable'],
            'infoAdicional' => ['nullable'],
            'piso' => ['nullable'],
            'nombre' => ['required'],
            'apellidos' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
