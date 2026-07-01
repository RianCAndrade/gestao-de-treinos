<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_cadastro_valido_retorna_201_com_dados_usuario()
    {
        $dados = [
            'nome' => 'Artorias',
            'idade' => 25,
            'email' => 'artorias@email.com',
            'senha' => 'artorias123',
            'cpf' => '70012345678',
        ];

        $response = $this->postJson('/api/cadastro', $dados);

        $response->assertStatus(201)
        ->assertJsonStructure([
            'sucesso',
            'data' => ['id', 'nome', 'idade', 'email', 'cpf', 'created_at', 'updated_at']
        ])->assertJsonFragment(['sucesso'=>true]);

        $this->assertDatabaseHas('tb_usuarios', [
            'email' => 'artorias@email.com',
            'cpf' => '70012345678',
        ]);
    }
}