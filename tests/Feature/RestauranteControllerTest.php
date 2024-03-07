<?php

namespace Tests\Feature;

use App\Models\Direccion;
use App\Models\Restaurante;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class RestauranteControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $restaurantes;
    protected $direcciones;
    protected User $user;
    protected User $admin;

    public function setUp(): void
    {
        parent::setUp();

        $this->direcciones = Direccion::factory()->count(3)->create();
        $this->restaurantes = Restaurante::factory()->count(3)->create();

        $this->user = User::factory()->create();
        $this->admin = User::factory()->create(['rol' => 'ADMIN']);
    }

    public function testIndex()
    {
        $response = $this->get(route('restaurantes.index'));

        $response->assertStatus(200);

        foreach ($this->restaurantes as $restaurante) {
            $response->assertSee($restaurante->nombre);
        }
    }

    public function testShow()
    {
        $response = $this->get(route('restaurantes.show', $this->restaurantes[0]->id));

        $response->assertStatus(200);
        $response->assertSee($this->restaurantes[0]->nombre);
    }

    public function testCreateForbidden()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('restaurantes.create'));

        $response->assertStatus(403);
    }

    public function testCreateAccessForm()
    {
        $this->actingAs($this->admin);

        $response = $this->get(route('restaurantes.create'));

        $response->assertStatus(200);
    }

    public function testCreateRestaurante()
    {
        $this->actingAs($this->admin);

        $data = [
            'nombre' => 'Nuevo Restaurante',
            'capacidad' => 100,
            'direccion_id' => $this->direcciones[0]->id,
        ];

        $response = $this->post(route('restaurantes.store'), $data);

        $response->assertRedirect(route('index'));
        //$this->assertDatabaseHas('restaurantes', $data);
    }

    public function testEditForbidden()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('restaurantes.edit', $this->restaurantes[0]->id));

        $response->assertStatus(403);
    }

    public function testEditAccessForm()
    {
        $this->actingAs($this->admin);

        $response = $this->get(route('restaurantes.edit', $this->restaurantes[0]->id));

        $response->assertStatus(200);
    }

    public function testEditRestaurante()
    {
        $this->actingAs($this->admin);

        $data = [
            'nombre' => 'Restaurante Actualizado',
            'capacidad' => 150,
            'direccion_id' => $this->direcciones[1]->id,
        ];

        $response = $this->put(route('restaurantes.update', $this->restaurantes[0]->id), $data);

        $response->assertRedirect(route('index'));
        //$this->assertDatabaseHas('restaurantes', $data);
    }

    public function testDeleteForbidden()
    {
        $this->actingAs($this->user);

        $response = $this->delete(route('restaurantes.destroy', $this->restaurantes[0]->id));

        $response->assertStatus(403);
    }

    public function testDeleteRestaurante()
    {
        $this->actingAs($this->admin);

        $response = $this->delete(route('restaurantes.destroy', $this->restaurantes[0]->id));

        $response->assertRedirect(route('restaurantes.index'));
        $this->assertDatabaseHas('restaurantes', [
            'id' => $this->restaurantes[0]->id,
            'deleted_at' => now(),
        ]);
    }
}

