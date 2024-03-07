<?php

namespace Database\Seeders;

use App\Models\User;
use DB;
use Illuminate\Database\Seeder;

class DireccionPersonalTableSeeder extends Seeder
{
    public function run(): void
    {
        $user_id = User::where('name', '=', 'user')->first()->id;

        DB::table('direcciones_personales')->insert([
            'id' =>'e7b14e2f-0f7b-4859-ae0e-35db13f55f5b',
            'pais' => 'España',
            'provincia' => 'Madrid',
            'municipio' => 'Leganés',
            'codigoPostal' => '28911',
            'calle' => 'Calle del Ejemplo 1',
            'numero' => '123',
            'portal' => '2',
            'infoAdicional' => 'Cuidado con el perro',
            'piso' => 'bajo a',
            'nombre'=> 'Casa',
            'apellidos' => 'de Leganes',

            'user_id' => $user_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('direcciones_personales')->insert([
                'id' =>'3b8f7998-89bb-4c65-b8e5-6e81cfc33c11',
                'pais' => 'España',
                'provincia' => 'Madrid',
                'municipio' => 'Fuenla',
                'codigoPostal' => '28911',
                'calle' => 'Calle del Ejemplo 2',
                'numero' => '123',
                'nombre'=> 'Chaletazo',
                'apellidos' => 'de Fuenla',

                'user_id' => $user_id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
    }
}
