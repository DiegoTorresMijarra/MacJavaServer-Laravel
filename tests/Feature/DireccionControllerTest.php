<?php

namespace Tests\Feature;

use App\Models\Direccion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DireccionControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $direcciones;
    protected User $user;
    protected User $admin;

    public function setUp(): void
    {
        parent::setUp();

        $this->direcciones = Direccion::factory()->count(3)->create();
        $this->user = User::factory()->create();
        $this->admin = User::factory()->create(['rol' => 'ADMIN']);
    }

    public function testShow()
    {
        $this->actingAs($this->admin);
        $response = $this->get(route('direcciones.show', $this->direcciones[0]->id));
        $response->assertStatus(200);
        $response->assertSee($this->direcciones[0]->calle);
    }
    public function testShowForbidden()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('direcciones.show', $this->direcciones[0]->id));
        $response->assertStatus(403);
    }

    public function testCreateForbidden()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('direcciones.create'));
        $response->assertStatus(403);
    }

    public function testCreateAccessForm()
    {
        $this->actingAs($this->admin);

        $response = $this->get(route('direcciones.create'));
        $response->assertStatus(200);
    }

    public function testCreateDireccion()
    {
        $this->actingAs($this->admin);

        $data = [
            'pais' => 'Nuevo País',
            'provincia' => 'Nueva Provincia',
            'municipio' => 'Nuevo Municipio',
            'codigoPostal' => '12345',
            'calle' => 'Nueva Calle',
            'numero' => '123',
            'portal' => 'Nuevo Portal',
            'infoAdicional' => 'Información Adicional',
            'piso' => 'Nuevo Piso',
        ];

        $response = $this->post(route('direcciones.store'), $data);
        $response->assertRedirect(route('restaurantes.index'));
        $this->assertDatabaseHas('direcciones', $data);
    }

    public function testEditForbidden()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('direcciones.edit', $this->direcciones[0]->id));
        $response->assertStatus(403);
    }

    public function testEditAccessForm()
    {
        $this->actingAs($this->admin);

        $response = $this->get(route('direcciones.edit', $this->direcciones[0]->id));
        $response->assertStatus(200);
    }

    public function testEditDireccion()
    {
        $this->actingAs($this->admin);

        $data = [
            'pais' => 'País Actualizado',
            'provincia' => 'Provincia Actualizada',
            'municipio' => 'Municipio Actualizado',
            'codigoPostal' => '54321',
            'calle' => 'Calle Actualizada',
            'numero' => '321',
            'portal' => 'Portal Actualizado',
            'infoAdicional' => 'Información Actualizada',
            'piso' => 'Piso Actualizado',
        ];

        $response = $this->put(route('direcciones.update', $this->direcciones[0]->id), $data);
        $response->assertRedirect(route('restaurantes.index'));
        $this->assertDatabaseHas('direcciones', $data);
    }

    public function testDeleteForbidden()
    {
        $this->actingAs($this->user);

        $response = $this->delete(route('direcciones.destroy', $this->direcciones[0]->id));
        $response->assertStatus(403);
    }

    public function testDeleteDireccion()
    {
        $this->actingAs($this->admin);

        $response = $this->delete(route('direcciones.destroy', $this->direcciones[0]->id));
        $response->assertRedirect(route('restaurantes.index'));
        $this->assertDatabaseHas('direcciones', [
            'id' => $this->direcciones[0]->id,
            'deleted_at' => now(),
        ]);
    }
}

