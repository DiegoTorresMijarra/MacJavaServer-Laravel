<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TrabajadoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('trabajadores')->insert([
            [
                'id' => Str::uuid(),
                'nombre' => 'Raul',
                'apellidos' => 'Rodriguez',
                'dni'=>'53718368M',
                'nomina' => 1500,
                'puesto' => 'Encargado',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nombre' => 'Oscar',
                'apellidos' => 'Encabo',
                'dni'=>'53718369Y',
                'nomina' => 1300,
                'puesto' => 'Empleado',
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
