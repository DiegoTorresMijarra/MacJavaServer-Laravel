<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'nombre' => $this->faker->word(),
            'descripcion' => $this->faker->word(),
            'imagen' => $this->faker->word(),
            'stock' => $this->faker->randomNumber(),
            'precio' => $this->faker->randomFloat(),
        ];
    }
}
