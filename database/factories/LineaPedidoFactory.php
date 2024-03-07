<?php

namespace Database\Factories;

use App\Models\LineaPedido;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class LineaPedidoFactory extends Factory
{
    protected $model = LineaPedido::class;

    public function definition(): array
    {
        $producto = Producto::all()->first();
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'precio' => $producto->precio,
            'stock' => $producto->stock,
            'producto_id' => $producto->id,
            'pedido_id' => Pedido::all()->random(),
        ];
    }
}
