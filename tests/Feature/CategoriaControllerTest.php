<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class CategoriaControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $user;
    protected Categoria $categoria;

    public function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['rol' => 'ADMIN']);
        $this->user = User::factory()->create();
        $this->categoria = Categoria::factory()->create();

        Auth::login($this->admin);
    }

    public function testIndex()
    {
        $response = $this->get(route('categorias.index'));
        $response->assertStatus(200);
    }

    public function testShow()
    {
        $response = $this->get(route('categorias.show', $this->categoria->id));
        $response->assertStatus(200);
    }

    public function testCreate()
    {
        $response = $this->get(route('categorias.create'));
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $nombreEspecifico = 'nombre_personalizado';

        $nuevaCategoria = Categoria::create([
            'nombre' => $nombreEspecifico,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->post(route('categorias.store'), $nuevaCategoria->toArray());

        $response->assertRedirect(route('index'));
        $this->assertDatabaseHas('categorias', [
            'created_at' => $nuevaCategoria->created_at->toDateTimeString(),
            'updated_at' => $nuevaCategoria->updated_at->toDateTimeString(),
            'nombre' => $nombreEspecifico,
        ]);
    }



    public function testEdit()
    {
        $response = $this->get(route('categorias.edit', $this->categoria->id));
        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $nombreEspecifico = 'nombre_personalizado';

        $nuevaCategoria = Categoria::create([
            'nombre' => $nombreEspecifico,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->put(route('categorias.update', $this->categoria->id), $nuevaCategoria->toArray());

        $response->assertRedirect(route('index'));
        $this->assertDatabaseHas('categorias', [
            'created_at' => $nuevaCategoria->created_at->toDateTimeString(),
            'updated_at' => $nuevaCategoria->updated_at->toDateTimeString(),
            'nombre' => $nombreEspecifico,
        ]);
    }

    public function testDelete_Delete()
    {
        $response = $this->delete(route('categorias.destroy',$this->categoria->id));

        $response->assertRedirect(route('categorias.index'));
        $this->assertDatabaseHas('categorias', [
            'id'=>$this->categoria->id,
            'deleted_at' => now(),
        ]);
    }

    public function testDelete_Forbidden()
    {
        $this->actingAs($this->user);

        $response = $this->delete(route('categorias.destroy',$this->categoria->id));

        $response->assertStatus(403);
    }
    public function testCreateForbidden()
    {
        $this->actingAs($this->user);
        $response = $this->get(route('categorias.create'));

        $response->assertForbidden();
    }

    public function testEditForbidden()
    {
        $this->actingAs($this->user);
        $response = $this->get(route('categorias.edit', $this->categoria->id));

        $response->assertForbidden();
    }

    public function testUpdateForbidden()
    {
        $this->actingAs($this->user);
        $data = Categoria::factory()->raw();

        $response = $this->put(route('categorias.update', $this->categoria->id), $data);

        $response->assertForbidden();
    }

}
