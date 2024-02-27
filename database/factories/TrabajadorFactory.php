<?php

namespace Database\Factories;

use App\Models\Trabajador;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TrabajadorFactory extends Factory
{
    protected $model = Trabajador::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'nombre' => $this->faker->word(),
            'apellidos' => $this->faker->word(),
            'nomina' => $this->faker->randomFloat(),
            'puesto' => $this->faker->word(),
        ];
    }
}
