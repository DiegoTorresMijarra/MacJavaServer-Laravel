<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

class CarritoRequest extends FormRequest
{
    public function rules(): array
    {
        $direcciones = Auth::user()->direcciones()->pluck('id')->toArray();

        return [
            'numero_tarjeta'=>['required','regex:/^\d{4}-\d{4}-\d{4}-\d{4}$/'],
            'cvc'=>['required','integer','digits_between:3,4'],

            'direccion_personal_id'=>['required',Rule::in($direcciones)],
        ];
    }

    public function messages(): array
    {
        return [
            'direccion_personal_id.required' => 'Debes seleccionar una dirección para el pedido.',
            'direccion_personal_id.in' => 'La dirección seleccionada no es válida.',
        ];
    }

    public function validarYTransformar()
    {
        $this->validate($this->rules());

        return $this;
    }
}
