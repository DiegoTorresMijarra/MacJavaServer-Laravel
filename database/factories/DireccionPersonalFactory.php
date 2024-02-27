<?php

namespace Database\Factories;

use App\Models\DireccionPersonal;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class DireccionPersonalFactory extends Factory
{
    protected $model = DireccionPersonal::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'direccion' => $this->faker->words(),
            'nombre' => $this->faker->word(),
            'apellido' => $this->faker->word(),
        ];
    }
}
