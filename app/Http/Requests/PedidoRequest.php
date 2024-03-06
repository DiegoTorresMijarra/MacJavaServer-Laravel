<?php

namespace App\Http\Requests;

use App\Models\Pedido;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PedidoRequest extends FormRequest
{
    public function rules(): array
    {
        $direcciones = Auth::user()->direcciones()->pluck('id')->toArray();

        return [
            'estado' => ['nullable',Rule::in(Pedido::$ESTADOS_POSIBLES)],

            'precioTotal' => ['required', 'numeric'],
            'stockTotal' => ['required', 'integer'],

            'numero_tarjeta' => ['required'],
            'cvc' => ['required'],
            'direccion_personal_id'=>['required',Rule::in($direcciones)],

            'user_id' => ['required','exists:users,id']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'direccion_personal_id.required'=>'Debes seleccionar una direccion para el pedido',
            'direccion_personal_id.in' => 'La dirección seleccionada no es válida.',
        ];
    }

    public function validar(): void
    {
        $this->validate($this->rules());
    }

}
