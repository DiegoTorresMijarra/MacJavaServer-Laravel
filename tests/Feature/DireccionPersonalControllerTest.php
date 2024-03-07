<?php

namespace Tests\Feature;

use App\Models\DireccionPersonal;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class DireccionPersonalControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected DireccionPersonal $direccionPersonal;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->direccionPersonal = DireccionPersonal::factory()->create(['user_id' => $this->user->id]);

        Auth::login($this->user);
    }

    public function testCreate()
    {
        $response = $this->get(route('direccion-personal.create'));

        $response->assertStatus(200);
        $response->assertViewIs('direccionesPersonales.create');
    }

    public function testStore()
    {
        $data = DireccionPersonal::factory()->raw(['user_id' => $this->user->id]);

        $response = $this->post(route('direccion-personal.store'), $data);

        $response->assertRedirect(route('home'));
        $this->assertDatabaseHas('direcciones_personales', $data);
    }

    public function testShow()
    {
        $response = $this->get(route('direccion-personal.show', $this->direccionPersonal->id));

        $response->assertStatus(200);
        $response->assertViewIs('direccionesPersonales.show');
        $response->assertViewHas('direccion', $this->direccionPersonal);
    }

    public function testEdit()
    {
        $response = $this->get(route('direccion-personal.edit', $this->direccionPersonal->id));

        $response->assertStatus(200);
        $response->assertViewIs('direccionesPersonales.edit');
        $response->assertViewHas('direccion', $this->direccionPersonal);
    }

    public function testUpdate()
    {
        $data = DireccionPersonal::factory()->raw();

        $response = $this->put(route('direccion-personal.update', $this->direccionPersonal->id), $data);

        $response->assertRedirect(route('home'));
        $this->assertDatabaseHas('direcciones_personales', [
            'id' => $this->direccionPersonal->id,
            'created_at' => $this->direccionPersonal->created_at->toDateTimeString(),
            'updated_at' => $this->direccionPersonal->updated_at->toDateTimeString(),
            'pais' => $data['pais'],
            'provincia' => $data['provincia'],
            'municipio' => $data['municipio'],
            'codigoPostal' => $data['codigoPostal'],
            'calle' => $data['calle'],
            'numero' => $data['numero'],
            'portal' => $data['portal'],
            'infoAdicional' => $data['infoAdicional'],
            'piso' => $data['piso'],
            'nombre' => $data['nombre'],
            'apellidos' => $data['apellidos'],
        ]);
    }


    public function testDestroy()
    {
        $direccionPersonal = DireccionPersonal::factory()->create();

        $response = $this->delete(route('direccion-personal.destroy', $direccionPersonal->id));

        $response->assertRedirect(route('home'));
        $this->assertDatabaseMissing('direcciones_personales', ['id' => $direccionPersonal->id]);
    }


    public function testDestroyWithPedidos()
    {
        $direccionPersonal = DireccionPersonal::factory()->create();
        // Simula la existencia de pedidos asociados (comenta esto si no es aplicable en tu caso)
        // $direccionPersonal->pedidos()->create([...]);

        $response = $this->delete(route('direccion-personal.destroy', $direccionPersonal->id));

        $response->assertRedirect(route('home'));
        $this->assertDatabaseMissing('direcciones_personales', ['id' => $direccionPersonal->id]);
    }
}

