<?php

use App\Http\Controllers\CarritoController;
use App\Models\Categoria;
use App\Models\DireccionPersonal;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\User;

class CarritoControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $user;
    protected Categoria $categoria;
    protected $productos;
    protected DireccionPersonal $direccionPersonal;

    public function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['rol' => 'ADMIN']);
        $this->user = User::factory()->create();
        $this->categoria = Categoria::factory()->create();
        $this->productos = Producto::factory(2)->create(['categoria_id' => $this->categoria->id, 'stock' => 10]);
        $this->direccionPersonal = DireccionPersonal::factory()->create(['user_id' => $this->user->id]);

        Auth::login($this->admin);
    }

    public function testSingletonPedidoRetornaArrayVacioCuandoCarritoVacio()
    {
        Session::flush();

        $this->actingAs($this->user);

        $carrito = CarritoController::singletonPedido();

        $this->assertEmpty($carrito);
    }

    public function testSingletonPedidoRetornaCarritoCuandoHayElementos()
    {
        Session::flush();

        $this->actingAs($this->user);

        Session::put('carrito', [
            [
                'precio' => 10,
                'stock' => 2,
                'producto_id' => 1,
            ],
            [
                'precio' => 15,
                'stock' => 3,
                'producto_id' => 2,
            ],
        ]);

        $carrito = CarritoController::singletonPedido();

        $this->assertEquals([
            [
                'precio' => 10,
                'stock' => 2,
                'producto_id' => 1,
            ],
            [
                'precio' => 15,
                'stock' => 3,
                'producto_id' => 2,
            ],
        ], $carrito);
    }

    public function testAgregarProductoAlCarrito()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $producto = Producto::factory()->create();

        $producto = Producto::factory()->create();

        $response = $this->post(route('add-linea'), [
            'producto_id' => $producto->id,
            'stock' => 2,
            'precio' => 10,
        ]);

        $response->assertRedirect();
        $this->assertNotNull(Session::get('carrito'));
    }

    public function testObtenerCarritoVacio()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('carrito'));

        $response->assertSuccessful();
        $response->assertSee('No hay productos en el carrito');
    }

    public function testCrearPedido()
    {
        $this->actingAs($this->user);

        Session::put('carrito', [
            [
                'precio' => $this->productos[0]->precio,
                'stock' => 1,
                'producto_id' => $this->productos[0]->id,
            ],
            [
                'precio' => $this->productos[1]->precio,
                'stock' => 1,
                'producto_id' => $this->productos[1]->id,
            ],
        ]);

        $response = $this->post(route('finalizar-pedido'), [
            'direccion_personal_id' => $this->direccionPersonal->id,
            'numero_tarjeta' => '1234-5678-9012-3456',
            'cvc' => '123',
        ]);

        $response->assertRedirect(route('pedido.details', ['id' => Pedido::all()->first()->id]));

        $this->assertDatabaseHas('pedidos', [
            'user_id' => $this->user->id,
        ]);

        $this->assertNull(Session::get('carrito'));
    }

    public function testEliminarProductoDelCarrito()
    {
        $this->actingAs($this->user);

        Session::put('carrito', [
            [
                'precio' => $this->productos[0]->precio,
                'stock' => 1,
                'producto_id' => $this->productos[0]->id,
            ],
            [
                'precio' => $this->productos[1]->precio,
                'stock' => 1,
                'producto_id' => $this->productos[1]->id,
            ],
        ]);

        $response = $this->delete(route('delete-linea', ['producto_id' => $this->productos[0]->id]));

        $response->assertRedirect();

        self::assertCount(1, CarritoController::singletonPedido());
    }

    public function testAccesoNoAutorizadoAgregarProducto()
    {
        $this->actingAs($this->admin);

        $response = $this->post(route('add-linea'), []);

        $response->assertStatus(403);
    }
    public function testAccesoNoAutorizadoEliminarProducto()
    {
        $this->actingAs($this->admin);

        $response = $this->delete(route('delete-linea', ['producto_id' => $this->productos[0]->id]));

        $response->assertStatus(403);
    }
    public function testAccesoNoAutorizadoFinalizarPedido()
    {
        $this->actingAs($this->admin);

        $response = $this->post(route('finalizar-pedido'), []);

        $response->assertStatus(403);
    }
    public function testAccesoNoAutorizadoObtenerCarrito()
    {
        $this->actingAs($this->admin);

        $response = $this->get(route('carrito'));

        $response->assertStatus(403);
    }


    public function testAccesoNoAutorizadoAgregarProductoNoLogueado()
    {
        $response = $this->post(route('add-linea'), [
            'producto_id' => $this->productos[0]->id,
            'stock' => 2,
            'precio' => 10,
        ]);

        $response->assertStatus(403);
    }

    public function testAccesoNoAutorizadoObtenerCarritoNoLogueado()
    {
        $response = $this->get(route('carrito'));

        $response->assertStatus(403);
    }

    public function testAccesoNoAutorizadoCrearPedidoNoLogueado()
    {
        $response = $this->post(route('finalizar-pedido'), [
            'direccion_personal_id' => $this->direccionPersonal->id,
            'numero_tarjeta' => '1234-5678-9012-3456',
            'cvc' => '123',
        ]);
        $response->assertStatus(403);
    }

    public function testAccesoNoAutorizadoEliminarProductoNoLogueado()
    {
        $response = $this->delete(route('delete-linea', ['producto_id' => 0]));

        $response->assertStatus(403);
    }

}
/*
 *

}
*/
