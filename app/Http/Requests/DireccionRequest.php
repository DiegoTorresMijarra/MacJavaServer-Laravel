<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DireccionRequest extends FormRequest
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
            'portal' => ['required'],
            'infoAdicional' => ['required'],
            'piso' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
