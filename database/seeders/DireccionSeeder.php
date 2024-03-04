<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DireccionSeeder extends Seeder
{
    public function run(): void
    {
        //
        DB::table('direcciones')->insert([
            [
                'id' => '00000000-0000-0000-0001-000000000000',
                'pais' => 'España',
                'provincia' => 'Madrid',
                'municipio' => 'Leganes',
                'codigoPostal' => '28914',
                'calle' => 'Avenida de la rotonda',
                'numero' => '15',
                'portal' => '4',
                'piso' => '5',
                'infoAdicional' => 'Letra C',
            ],
            [
                'id' => '00000000-0000-0000-0002-000000000000',
                'pais' => 'España',
                'provincia' => 'Madrid',
                'municipio' => 'Alcorcon',
                'codigoPostal' => '28542',
                'calle' => 'Plaza España',
                'numero' => '3',
                'portal' => '17',
                'piso' => '3',
                'infoAdicional' => 'Letra A',
            ],
        ]);
    }
}
