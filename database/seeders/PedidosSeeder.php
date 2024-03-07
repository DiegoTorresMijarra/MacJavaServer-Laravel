<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PedidosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {

        $direcciones = User::find(3)->direcciones;

        DB::table('pedidos')->insert([
            [
                'id' => 'f0df90a6-0760-4b7b-b914-6d95398b0c41',
                'estado' => 'ENVIADO',
                'precioTotal' => 54.97,
                'stockTotal' => 3,
                'numero_tarjeta' => Crypt::encryptString('1234-5678-9012-3456'),
                'cvc' => Crypt::encryptString('123'),
                'user_id' => 3,
                'direccion_personal_id' => $direcciones[0]->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'cd457d5d-6a94-4f0f-8541-79244a2b4e58',
                'estado' => 'ENTREGADO',
                'precioTotal' => 64.95,
                'stockTotal' => 5,
                'numero_tarjeta' => Crypt::encryptString('9876-5432-1098-7654'),
                'cvc' => Crypt::encryptString('456'),
                'user_id' => 3,
                'direccion_personal_id' =>  $direcciones[1]->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
