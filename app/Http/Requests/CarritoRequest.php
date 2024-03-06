<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\DireccionPersonal;

class CarritoRequest extends FormRequest
{
    public function rules(): array
    {
        $direcciones = Auth::user()->direcciones()->get('id');

        return [
            'numero_tarjeta'=>['required','regex:/^\d{4}-\d{4}-\d{4}-\d{4}$/'],
            'cvc'=>['required','integer','max:9999'],
            'direccion_personal'=>['required',Rule::in($direcciones)],
        ];
    }

    public function messages(): array
    {
        return [
            'direccion_personal.in' => 'La dirección seleccionada no es válida.',
        ];
    }
}
