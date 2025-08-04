<?php

use App\Models\Client;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\CashRegister;

describe('Controller Cliente', function () {
    beforeEach(function () {
        // Criar dados de teste
        Service::factory()->count(2)->create();
        Appointment::factory()->count(3)->create();
        CashRegister::factory()->count(1)->create();
    });

    describe('GET /clients/create', function () {
        it('exibe formulário de criação de cliente', function () {
            $response = $this->get('/clients/create');

            $response->assertStatus(200);
            $response->assertViewIs('clients.create');
        });
    });

    describe('POST /clients', function () {
        it('pode criar um novo cliente com dados válidos', function () {
            $clientData = [
                'name' => 'João Silva',
                'phone' => '11999999999',
                'email' => 'joao@email.com'
            ];

            $response = $this->post('/clients', $clientData);

            $response->assertRedirect('/clients');
            $response->assertSessionHas('success', 'Cliente cadastrado com sucesso!');

            $this->assertDatabaseHas('clients', $clientData);
        });

        it('valida campos obrigatórios', function ($field) {
            $clientData = [
                'name' => 'João Silva',
                'phone' => '11999999999',
                'email' => 'joao@email.com'
            ];
            unset($clientData[$field]);

            $response = $this->post('/clients', $clientData);

            $response->assertSessionHasErrors($field);
        })->with(['name', 'phone', 'email']);

        it('valida formato do email', function () {
            $clientData = [
                'name' => 'João Silva',
                'phone' => '11999999999',
                'email' => 'email-invalido'
            ];

            $response = $this->post('/clients', $clientData);

            $response->assertSessionHasErrors('email');
        });
    });

    describe('GET /clients', function () {
        it('exibe página index de clientes', function () {
            Client::factory()->count(5)->create();

            $response = $this->get('/clients');

            $response->assertStatus(200);
            $response->assertViewIs('clients.index');
            $response->assertViewHas(['clients', 'services', 'appointments', 'cash_registers']);
        });

        it('mostra clientes paginados', function () {
            Client::factory()->count(20)->create();

            $response = $this->get('/clients');

            $response->assertStatus(200);
            $clients = $response->viewData('clients');
            expect($clients->perPage())->toBe(15);
            expect($clients->total())->toBe(20);
        });
    });

    describe('GET /clients/{client}/edit', function () {
        it('exibe formulário de edição de cliente', function () {
            $client = Client::factory()->create();

            $response = $this->get("/clients/{$client->id}/edit");

            $response->assertStatus(200);
            $response->assertViewIs('clients.edit');
            $response->assertViewHas('client', $client);
        });

        it('retorna 404 para cliente inexistente', function () {
            $response = $this->get('/clients/999/edit');

            $response->assertStatus(404);
        });
    });

    describe('PUT /clients/{client}', function () {
        it('pode atualizar cliente existente', function () {
            $client = Client::factory()->create([
                'name' => 'Nome Original',
                'phone' => '11111111111'
            ]);

            $updateData = [
                'name' => 'Nome Atualizado',
                'phone' => '11999999999',
                'email' => $client->email
            ];

            $response = $this->put("/clients/{$client->id}", $updateData);

            $response->assertRedirect('/clients');
            $response->assertSessionHas('success', 'Cliente atualizado com sucesso!');

            $this->assertDatabaseHas('clients', [
                'id' => $client->id,
                'name' => 'Nome Atualizado',
                'phone' => '11999999999'
            ]);
        });
    });

    describe('DELETE /clients/{client}', function () {
        it('pode deletar um cliente', function () {
            $client = Client::factory()->create();

            $response = $this->delete("/clients/{$client->id}");

            $response->assertRedirect('/clients');
            $response->assertSessionHas('success', 'Cliente excluído com sucesso!');

            $this->assertDatabaseMissing('clients', [
                'id' => $client->id
            ]);
        });
    });
})->uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);
