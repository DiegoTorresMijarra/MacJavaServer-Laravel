<?php

namespace Database\Factories;

use App\Models\Categoria;
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
            'nombre' => $this->faker->unique()->name(),
            'descripcion' => $this->faker->word(),
            'imagen' => $this->faker->word(),
            'stock' => $this->faker->randomNumber(2),
            'precio' => $this->faker->randomFloat(2,0,100),
            'categoria_id' => Categoria::all()->random()->id,
        ];
    }
}
