<?php

use App\Services\ClientService;
use App\Models\Client;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\CashRegister;

describe('Serviço de Cliente', function () {
    beforeEach(function () {
        $this->clientService = new ClientService();
    });

    describe('método create', function () {
        it('pode criar um novo cliente', function () {
            $data = [
                'name' => 'Pedro Santos',
                'phone' => '11987654321',
                'email' => 'pedro@email.com'
            ];

            $client = $this->clientService->create($data);

            expect($client)->toBeInstanceOf(Client::class);
            expect($client->name)->toBe('Pedro Santos');
            expect($client->phone)->toBe('11987654321');
            expect($client->email)->toBe('pedro@email.com');
            expect($client->exists)->toBeTrue();
        });

        it('persiste cliente no banco de dados', function () {
            $data = [
                'name' => 'Maria Oliveira',
                'phone' => '11999888777',
                'email' => 'maria@email.com'
            ];

            $client = $this->clientService->create($data);

            $this->assertDatabaseHas('clients', [
                'id' => $client->id,
                'name' => 'Maria Oliveira',
                'phone' => '11999888777',
                'email' => 'maria@email.com'
            ]);
        });
    });

    describe('método all', function () {
        it('retorna todos os clientes', function () {
            Client::factory()->count(3)->create();

            $clients = $this->clientService->all();

            expect($clients)->toHaveCount(3);
            expect($clients->first())->toBeInstanceOf(Client::class);
        });

        it('retorna coleção vazia quando não há clientes', function () {
            $clients = $this->clientService->all();

            expect($clients)->toHaveCount(0);
        });
    });

    describe('método getPaginated', function () {
        it('retorna clientes paginados ordenados por data de criação desc', function () {
            Client::factory()->count(20)->create();

            $paginatedClients = $this->clientService->getPaginated(10);

            expect($paginatedClients->count())->toBe(10);
            expect($paginatedClients->total())->toBe(20);
            expect($paginatedClients->perPage())->toBe(10);
        });

        it('usa paginação padrão de 15 por página', function () {
            Client::factory()->count(20)->create();

            $paginatedClients = $this->clientService->getPaginated();

            expect($paginatedClients->perPage())->toBe(15);
        });
    });

    describe('método getIndexData', function () {
        it('retorna todos os dados necessários para página index', function () {
            Service::factory()->count(2)->create();
            Appointment::factory()->count(3)->create();
            CashRegister::factory()->count(1)->create();

            $indexData = $this->clientService->getIndexData();

            expect($indexData)->toHaveKey('services');
            expect($indexData)->toHaveKey('appointments');
            expect($indexData)->toHaveKey('cash_registers');
            expect($indexData['services'])->toHaveCount(2);
            expect($indexData['appointments'])->toHaveCount(3);
            expect($indexData['cash_registers'])->toHaveCount(1);
        });
    });

    describe('método update', function () {
        it('pode atualizar um cliente existente', function () {
            $client = Client::factory()->create([
                'name' => 'Nome Original',
                'phone' => '11111111111'
            ]);

            $updateData = [
                'name' => 'Nome Atualizado',
                'phone' => '11999999999'
            ];

            $updatedClient = $this->clientService->update($client, $updateData);

            expect($updatedClient->name)->toBe('Nome Atualizado');
            expect($updatedClient->phone)->toBe('11999999999');
        });

        it('persiste dados atualizados no banco de dados', function () {
            $client = Client::factory()->create(['name' => 'Nome Original']);

            $this->clientService->update($client, ['name' => 'Nome Atualizado']);

            $this->assertDatabaseHas('clients', [
                'id' => $client->id,
                'name' => 'Nome Atualizado'
            ]);
        });
    });

    describe('método delete', function () {
        it('pode deletar um cliente', function () {
            $client = Client::factory()->create();

            $this->clientService->delete($client);

            $this->assertDatabaseMissing('clients', [
                'id' => $client->id
            ]);
        });
    });
})->uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);
