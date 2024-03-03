<?php

namespace Database\Factories;

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
            'estado' => $this->faker->word(),
            'precioTotal' => $this->faker->randomFloat(),
            'stockTotal' => $this->faker->randomNumber(),
        ];
    }
}
