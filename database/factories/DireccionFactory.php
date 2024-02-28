<?php

namespace Database\Factories;

use App\Models\Direccion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class DireccionFactory extends Factory
{
    protected $model = Direccion::class;

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
        ];
    }
}
