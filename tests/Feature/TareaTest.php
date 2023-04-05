<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TareaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_api_incert_tarea_usuario()
    {
        $this->withoutExceptionHandling();
        $this->expectNotToPerformAssertions();


        $user = \App\Models\User::find(2);

        $this->actingAs($user);

        $response = $this->post('/api/tareas/', [
            'nombre' => 'Tarea programada desde phpunit',

        ]);
        dump('-- Registrar Tarea --');
        $response->dump();

        //Edicion
        $tarea = \App\Models\Tarea::orderBy("id", "desc")->first();
        $responseEdit = $this->put('/api/tareas/' . $tarea->id, [
            'nombre' => 'Tarea programada desde phpunit - Editar',
        ]);
        dump('-- Editar Tarea --');
        $responseEdit->dump();

        //Listar Tareas

        $responseListar = $this->get('/api/tareas/');
        dump('-- Listar Tareas --');
        $responseListar->dump();

        //Eliminar Tarea

        $responsedelete = $this->delete('/api/tareas/'. $tarea->id);
        dump('-- Eliminar Tarea --');

        $responseListar2 = $this->get('/api/tareas/');
        dump('-- Listar final Tareas --');
        $responseListar2->dump();

    }
}
