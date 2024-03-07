<?php

namespace Tests\Feature;

use App\Http\Resources\PedidoResource;
use App\Models\Categoria;
use App\Models\DireccionPersonal;
use App\Models\LineaPedido;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\User;
use Auth;
use Database\Factories\LineaPedidoFactory;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PedidosControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testBasic()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    protected User $admin;
    protected User $user;
    protected Categoria $categoria;
    protected $productos;
    protected DireccionPersonal $direccionPersonal;
    protected Pedido $pedido;
    protected $lineas;

    public function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['rol' => 'ADMIN']);
        $this->user = User::factory()->create();
        $this->categoria = Categoria::factory()->create();
        $this->productos = Producto::factory(2)->create(['categoria_id' => $this->categoria->id, 'stock' => 10]);
        $this->direccionPersonal = DireccionPersonal::factory()->create(['user_id' => $this->user->id]);

        $this->pedido = Pedido::factory()->create(['user_id' => $this->user->id, 'direccion_personal_id' => $this->direccionPersonal->id]);
        $this->lineas = LineaPedido::factory(3)->create(['pedido_id' => $this->pedido->id]);

        Auth::login($this->admin);
    }



    public function testMostrarPedido()
    {
        $response = $this->actingAs($this->user)->get(route('pedido.details', ['id' => $this->pedido->id]));

        $response->assertStatus(200);
        $response->assertViewIs('pedidos.show');
        $response->assertSee($this->pedido->id);
    }
    
}
