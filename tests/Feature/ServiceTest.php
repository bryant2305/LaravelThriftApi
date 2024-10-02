<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Servicios;

class ServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_all_services(): void
    {
        $user = User::first();

        // Autentica al usuario
        $this->actingAs($user, 'sanctum');

        // Realiza la petición
        $response = $this->get('/api/servicios');

        // Verifica la respuesta
        $response->assertStatus(200);
    }
    public function test_create_service(): void
    {
        $user = User::first();

        // Autentica al usuario
        $this->actingAs($user, 'sanctum');

        $data = [
            'nombre' => 'Servicio de prueba',
            'precio' => '10.00',
            // Añade más campos que sean necesarios para crear el servicio
        ];

        // Realiza la petición
        $response = $this->post('/api/servicios/store' , $data);

        // Verifica la respuesta
        $response->assertStatus(200);
    }


    public function test_update_service(): void
    {
        $user = User::first();

        // Autentica al usuario
        $this->actingAs($user, 'sanctum');

        $service = Servicios::first();

        $data = [
            'nombre' => 'Servicio de prueba',
            'precio' => '10.00',
            // Añade más campos que sean necesarios para crear el servicio
        ];

        // Realiza la petición
        $response = $this->put("/api/servicios/{$service->id}/update" , $data);

        // Verifica la respuesta
        $response->assertStatus(200);
    }

    public function test_delete_service(): void
    {
        $user = User::first();

        // Autentica al usuario
        $this->actingAs($user, 'sanctum');

        $service = Servicios::first();

        // Realiza la petición
        $response = $this->delete("/api/servicios/{$service->id}");

        // Verifica la respuesta
        $response->assertStatus(200);
    }
}
