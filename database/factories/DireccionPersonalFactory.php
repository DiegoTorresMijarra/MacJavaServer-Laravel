<?php

namespace Database\Factories;

use App\Models\DireccionPersonal;
use App\Models\User;
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
            'pais' => $this->faker->word(),
            'provincia' => $this->faker->word(),
            'municipio' => $this->faker->word(),
            'codigoPostal' => $this->faker->postcode(),
            'calle' => $this->faker->word(),
            'numero' => $this->faker->word(),
            'portal' => $this->faker->word(),
            'infoAdicional' => $this->faker->word(),
            'piso' => $this->faker->word(),
            'nombre' => $this->faker->word(),
            'apellidos' => $this->faker->word(),
            'user_id' => User::all()->random()->id,
        ];
    }
}
