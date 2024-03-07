<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProductoControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $productos;
    protected $categorias;

    protected User $user;
    protected User $admin;
    protected Producto|\Mockery\LegacyMockInterface|\Mockery\MockInterface $mockProducto;

    public function setUp(): void
    {
        parent::setUp();

        $mockProducto = null;
        $this->$mockProducto = \Mockery::mock(Producto::class);;
        $this->categorias = Categoria::factory()->count(3)->create();
        $this->productos = Producto::factory()->count(3)->create();

        $this->user = User::factory()->create();
        $this->admin = User::factory()->create();
        $this->admin->rol = 'ADMIN';
    }

    public function testIndex()
    {
        $response = $this->get(route('productos.index'));

        $response->assertStatus(200);

        foreach ($this->productos as $producto) {
            $response->assertSee($producto->nombre);
        }
    }

    public function testShow()
    {
        $response = $this->get(route('productos.show', $this->productos[0]->id));

        $response->assertStatus(200);
        $response->assertSee($this->productos[0]->nombre);
    }

    public function testCreateForbidden()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('productos.create'));

        $response->assertStatus(403);
    }

    public function testCreateAccessForm()
    {
        $this->actingAs($this->admin);

        $response = $this->get(route('productos.create'));

        $response->assertStatus(200);
    }

    public function testCreateProducto()
    {
        $this->actingAs($this->admin);

        $data = [
            'nombre' => 'Nuevo Producto',
            'precio' => 19.99,
            'stock' => 50,
            'descripcion' => 'Descripción del nuevo Producto',
            'categoria_id' => $this->categorias[0]->id,
        ];

        $response = $this->post(route('productos.store'), $data);

        $response->assertRedirect(route('productos.index'));
        $this->assertDatabaseHas('productos', $data);
    }

    public function testEditForbidden()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('productos.edit', $this->productos[0]->id));

        $response->assertStatus(403);
    }

    public function testEditAccessForm()
    {
        $this->actingAs($this->admin);

        $response = $this->get(route('productos.edit', $this->productos[0]->id));

        $response->assertStatus(200);
    }

    public function testEditProducto()
    {
        $this->actingAs($this->admin);

        $data = [
            'nombre' => 'Producto Actualizado',
            'precio' => 25.99,
            'stock' => 75,
            'descripcion' => 'Descripción del Producto actualizado',
            'categoria_id' => $this->categorias[1]->id,
        ];

        $response = $this->put(route('productos.update', $this->productos[0]->id), $data);

        $response->assertRedirect(route('productos.index'));
        $this->assertDatabaseHas('productos', $data);
    }

    public function testDeleteForbidden()
    {
        $this->actingAs($this->user);

        $response = $this->delete(route('productos.destroy', $this->productos[0]->id));

        $response->assertStatus(403);
    }

    public function testDeleteProducto()
    {
        $this->actingAs($this->admin);

        $response = $this->delete(route('productos.destroy', $this->productos[0]->id));

        $response->assertRedirect(route('productos.index'));
        $this->assertDatabaseHas('productos', [
            'id' => $this->productos[0]->id,
            'deleted_at' => now(),
        ]);
    }

    public function testEditImageForbidden()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('productos.editImage', $this->productos[0]->id));

        $response->assertStatus(403);
    }

    public function testEditImageAccessForm()
    {
        $this->actingAs($this->admin);

        $response = $this->get(route('productos.editImage', $this->productos[0]->id));

        $response->assertStatus(200);
    }
}

