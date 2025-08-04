<?php

use App\Models\Service;

describe('Controller Serviço', function () {
    describe('Endpoints da API de Serviços', function () {
        it('pode criar um novo serviço', function () {
            $serviceData = [
                'name' => 'Corte de Cabelo',
                'price' => 50.00,
                'duration_minutes' => 30
            ];

            $response = $this->post('/services', $serviceData);

            $response->assertRedirect();
            $this->assertDatabaseHas('services', $serviceData);
        });

        it('valida campos obrigatórios do serviço', function ($field) {
            $serviceData = [
                'name' => 'Escova',
                'price' => 80.00,
                'duration_minutes' => 45
            ];
            unset($serviceData[$field]);

            $response = $this->post('/services', $serviceData);

            $response->assertSessionHasErrors($field);
        })->with(['name', 'price', 'duration_minutes']);

        it('valida que preço é numérico', function () {
            $serviceData = [
                'name' => 'Manicure',
                'price' => 'não-é-número',
                'duration_minutes' => 60
            ];

            $response = $this->post('/services', $serviceData);

            $response->assertSessionHasErrors('price');
        });

        it('valida que duração é inteiro', function () {
            $serviceData = [
                'name' => 'Pedicure',
                'price' => 40.00,
                'duration_minutes' => 'não-é-número'
            ];

            $response = $this->post('/services', $serviceData);

            $response->assertSessionHasErrors('duration_minutes');
        });

        it('pode listar todos os serviços', function () {
            Service::factory()->count(3)->create();

            $response = $this->get('/services');

            $response->assertStatus(200);
            $response->assertViewHas('services');
        });

        it('pode atualizar um serviço', function () {
            $service = Service::factory()->create([
                'name' => 'Nome Original',
                'price' => 50.00
            ]);

            $updateData = [
                'name' => 'Nome Atualizado',
                'price' => 75.00,
                'duration_minutes' => $service->duration_minutes
            ];

            $response = $this->put("/services/{$service->id}", $updateData);

            $response->assertRedirect();
            $this->assertDatabaseHas('services', [
                'id' => $service->id,
                'name' => 'Nome Atualizado',
                'price' => 75.00
            ]);
        });

        it('pode deletar um serviço', function () {
            $service = Service::factory()->create();

            $response = $this->delete("/services/{$service->id}");

            $response->assertRedirect();
            $this->assertDatabaseMissing('services', [
                'id' => $service->id
            ]);
        });
    });
})->uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);
