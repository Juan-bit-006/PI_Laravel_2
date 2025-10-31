<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Cliente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class ClienteTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function un_usuario_autenticado_puede_ver_el_listado_de_clientes()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Cliente::factory()->count(3)->create();

        $response = $this->get('/clientes');

        $response->assertStatus(200);
        $response->assertSeeText('Clientes');
    }

    /** @test */
    public function un_usuario_autenticado_puede_crear_un_cliente()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'nombre' => 'Juan Pérez',
            'telefono' => '3001234567',
            'email' => 'juan@example.com',
        ];

        $response = $this->post('/clientes', $data);

        $response->assertRedirect('/clientes');
        $this->assertDatabaseHas('clientes', ['nombre' => 'Juan Pérez']);
    }

    /** @test */
    public function un_usuario_autenticado_puede_actualizar_un_cliente()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $cliente = Cliente::factory()->create();

        $response = $this->put("/clientes/{$cliente->id}", [
            'nombre' => 'Cliente Editado',
            'telefono' => '3115556666',
            'email' => 'editado@example.com',
        ]);

        $response->assertRedirect('/clientes');
        $this->assertDatabaseHas('clientes', ['nombre' => 'Cliente Editado']);
    }

    /** @test */
    public function un_usuario_autenticado_puede_eliminar_un_cliente()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $cliente = Cliente::factory()->create();

        $response = $this->delete("/clientes/{$cliente->id}");
        $response->assertRedirect('/clientes');

        $this->assertDatabaseMissing('clientes', ['id' => $cliente->id]);
    }
}
