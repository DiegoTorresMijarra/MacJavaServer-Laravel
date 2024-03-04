<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('productos')->insert([
            [
                'nombre' => 'MacJava',
                'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur placerat urna id tortor vulputate tincidunt. Donec est purus, placerat sit amet iaculis a, fringilla non justo.',
                'precio' => 10.99,
                'stock' => 5,
                'oferta' => false,
                'categoria_id' => 1,
            ],
            [
                'nombre' => 'Tarta de queso',
                'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur placerat urna id tortor vulputate tincidunt. Donec est purus, placerat sit amet iaculis a, fringilla non justo.',
                'precio' => 5.99,
                'stock' => 10,
                'oferta' => false,
                'categoria_id' => 3,
            ],
            [
                'nombre' => 'Variado de croquetas',
                'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur placerat urna id tortor vulputate tincidunt. Donec est purus, placerat sit amet iaculis a, fringilla non justo.',
                'precio' => 15.99,
                'stock' => 15,
                'oferta' => false,
                'categoria_id' => 2,
            ],
            [
                'nombre' => 'Pizza 4 Frameworks',
                'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur placerat urna id tortor vulputate tincidunt. Donec est purus, placerat sit amet iaculis a, fringilla non justo.',
                'precio' => 12.99,
                'stock' => 20,
                'oferta' => false,
                'categoria_id' => 1,
            ],
            [
                'nombre' => 'Combo de bebidas',
                'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur placerat urna id tortor vulputate tincidunt. Donec est purus, placerat sit amet iaculis a, fringilla non justo.',
                'precio' => 5.99,
                'stock' => 15,
                'oferta' => true,
                'categoria_id' => 4,
            ],
            [
                'nombre' => 'Spaguetis C++',
                'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur placerat urna id tortor vulputate tincidunt. Donec est purus, placerat sit amet iaculis a, fringilla non justo.',
                'precio' => 8.99,
                'stock' => 20,
                'oferta' => false,
                'categoria_id' => 1,
            ],
            [
                'nombre' => 'Combo de entrantes',
                'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur placerat urna id tortor vulputate tincidunt. Donec est purus, placerat sit amet iaculis a, fringilla non justo.',
                'precio' => 40.99,
                'stock' => 20,
                'oferta' => true,
                'categoria_id' => 2,
            ],
            [
                'nombre' => 'HelaDoc',
                'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur placerat urna id tortor vulputate tincidunt. Donec est purus, placerat sit amet iaculis a, fringilla non justo.',
                'precio' => 2.99,
                'stock' => 20,
                'oferta' => false,
                'categoria_id' => 3,
            ],
            [
                'nombre' => '2x1 en PHP',
                'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur placerat urna id tortor vulputate tincidunt. Donec est purus, placerat sit amet iaculis a, fringilla non justo.',
                'precio' => 10.99,
                'stock' => 20,
                'oferta' => true,
                'categoria_id' => 1,
            ],
        ]);
    }
}