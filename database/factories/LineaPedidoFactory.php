<?php

namespace Database\Factories;

use App\Models\LineaPedido;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class LineaPedidoFactory extends Factory
{
    protected $model = LineaPedido::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'precio' => $this->faker->randomFloat(),
            'stock' => $this->faker->randomNumber(),
        ];
    }
}
