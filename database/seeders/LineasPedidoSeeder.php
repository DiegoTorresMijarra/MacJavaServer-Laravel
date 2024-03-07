<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LineasPedidoSeeder extends Seeder
{
    public function run(): void
    {
        $pedidos = User::find(3)->pedidos;
        DB::table('lineas_pedidos')->insert([
            [
                'id' => Str::uuid(),
                'pedido_id' => $pedidos[0]->id,
                'producto_id' => 1,
                'stock' => 2,
                'precio' => 10.99,
            ],
            [
                'id' => Str::uuid(),
                'pedido_id' => $pedidos[0]->id,
                'producto_id' => 2,
                'stock' => 1,
                'precio' => 5.99,
            ],
            [
                'id' => Str::uuid(),
                'pedido_id' => $pedidos[1]->id,
                'producto_id' => 1,
                'stock' => 3,
                'precio' => 10.99,
            ],
            [
                'id' => Str::uuid(),
                'pedido_id' => $pedidos[1]->id,
                'producto_id' => 3,
                'stock' => 2,
                'precio' => 15.99,
            ],
        ]);
    }
}
