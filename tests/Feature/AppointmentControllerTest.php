<?php

use App\Models\Appointment;
use App\Models\Client;
use App\Models\Service;

describe('Controller Agendamento', function () {
    beforeEach(function () {
        $this->client = Client::factory()->create();
        $this->service = Service::factory()->create();
    });

    describe('Operações CRUD de Agendamento', function () {
        it('pode criar um novo agendamento', function () {
            $appointmentData = [
                'client_id' => $this->client->id,
                'service_id' => $this->service->id,
                'scheduled_at' => now()->addDays(1)->format('Y-m-d H:i:s'),
                'duration_minutes' => 60,
                'status' => 'scheduled'
            ];

            $response = $this->post('/appointments', $appointmentData);

            $response->assertRedirect();
            $this->assertDatabaseHas('appointments', [
                'client_id' => $this->client->id,
                'service_id' => $this->service->id,
                'status' => 'scheduled'
            ]);
        });

        it('valida campos obrigatórios do agendamento', function ($field) {
            $appointmentData = [
                'client_id' => $this->client->id,
                'service_id' => $this->service->id,
                'scheduled_at' => now()->addDays(1),
                'duration_minutes' => 60,
                'status' => 'scheduled'
            ];
            unset($appointmentData[$field]);

            $response = $this->post('/appointments', $appointmentData);

            $response->assertSessionHasErrors($field);
        })->with(['client_id', 'service_id', 'scheduled_at']);

        it('valida que cliente existe', function () {
            $appointmentData = [
                'client_id' => 999, // ID inexistente
                'service_id' => $this->service->id,
                'scheduled_at' => now()->addDays(1),
                'duration_minutes' => 60,
                'status' => 'scheduled'
            ];

            $response = $this->post('/appointments', $appointmentData);

            $response->assertSessionHasErrors('client_id');
        });

        it('valida que serviço existe', function () {
            $appointmentData = [
                'client_id' => $this->client->id,
                'service_id' => 999, // ID inexistente
                'scheduled_at' => now()->addDays(1),
                'duration_minutes' => 60,
                'status' => 'scheduled'
            ];

            $response = $this->post('/appointments', $appointmentData);

            $response->assertSessionHasErrors('service_id');
        });

        it('pode listar agendamentos', function () {
            Appointment::factory()->count(3)->create();

            $response = $this->get('/appointments');

            $response->assertStatus(200);
            $response->assertViewHas('appointments');
        });

        it('pode atualizar status do agendamento', function () {
            $appointment = Appointment::factory()->create(['status' => 'scheduled']);

            $updateData = [
                'client_id' => $appointment->client_id,
                'service_id' => $appointment->service_id,
                'scheduled_at' => $appointment->scheduled_at,
                'duration_minutes' => $appointment->duration_minutes,
                'status' => 'completed'
            ];

            $response = $this->put("/appointments/{$appointment->id}", $updateData);

            $response->assertRedirect();
            $this->assertDatabaseHas('appointments', [
                'id' => $appointment->id,
                'status' => 'completed'
            ]);
        });

        it('pode cancelar um agendamento', function () {
            $appointment = Appointment::factory()->create();

            $response = $this->delete("/appointments/{$appointment->id}");

            $response->assertRedirect();
            $this->assertDatabaseMissing('appointments', [
                'id' => $appointment->id
            ]);
        });

        it('carrega dados relacionados de cliente e serviço', function () {
            $appointment = Appointment::factory()->create([
                'client_id' => $this->client->id,
                'service_id' => $this->service->id
            ]);

            expect($appointment->client->name)->toBe($this->client->name);
            expect($appointment->service->name)->toBe($this->service->name);
        });
    });
})->uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);
