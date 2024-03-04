<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestauranteSeeder extends Seeder
{
    public function run(): void
    {
        //
        DB::table('restaurantes')->insert([
            [
                'nombre' => 'MacJavaLeganes',
                'capacidad' => 40,
                'direccion_id' => '00000000-0000-0000-0001-000000000000'
            ],
            [
                'nombre' => 'MacJavaAlcorcon',
                'capacidad' => 30,
                'direccion_id' => '00000000-0000-0000-0002-000000000000'
            ],
        ]);
    }
}
