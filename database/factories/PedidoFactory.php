<?php

namespace Database\Factories;

use App\Models\DireccionPersonal;
use App\Models\Pedido;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PedidoFactory extends Factory
{
    protected $model = Pedido::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'estado' => $this->faker->randomElement(Pedido::$ESTADOS_POSIBLES),
            'numero_tarjeta' => $this->faker->word(),
            'direccion_personal_id' => DireccionPersonal::all()->first()->id,
            'cvc' => $this->faker->word,
            'precioTotal' => $this->faker->randomFloat(2,0,100),
            'stockTotal' => $this->faker->randomNumber(1,100),
        ];
    }
}
