<?php

use App\Models\Appointment;
use App\Models\Client;
use App\Models\Service;

describe('Model Agendamento', function () {
    it('pode ser criado com dados válidos', function () {
        $client = Client::factory()->create();
        $service = Service::factory()->create();

        $appointment = Appointment::factory()->create([
            'client_id' => $client->id,
            'service_id' => $service->id,
            'scheduled_at' => now()->addDay(),
            'duration_minutes' => 60,
            'status' => 'scheduled'
        ]);

        expect($appointment->client_id)->toBe($client->id);
        expect($appointment->service_id)->toBe($service->id);
        expect($appointment->duration_minutes)->toBe(60);
        expect($appointment->status)->toBe('scheduled');
    });

    it('possui atributos preenchíveis', function () {
        $fillable = ['client_id', 'service_id', 'scheduled_at', 'duration_minutes', 'status'];

        expect((new Appointment())->getFillable())->toBe($fillable);
    });

    it('pertence a um cliente', function () {
        $appointment = Appointment::factory()->create();

        expect($appointment->client())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class);
        expect($appointment->client)->toBeInstanceOf(Client::class);
    });

    it('pertence a um serviço', function () {
        $appointment = Appointment::factory()->create();

        expect($appointment->service())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class);
        expect($appointment->service)->toBeInstanceOf(Service::class);
    });

    it('pode recuperar nome do cliente através do relacionamento', function () {
        $client = Client::factory()->create(['name' => 'Maria Silva']);
        $appointment = Appointment::factory()->create(['client_id' => $client->id]);

        expect($appointment->client->name)->toBe('Maria Silva');
    });

    it('pode recuperar nome do serviço através do relacionamento', function () {
        $service = Service::factory()->create(['name' => 'Manicure']);
        $appointment = Appointment::factory()->create(['service_id' => $service->id]);

        expect($appointment->service->name)->toBe('Manicure');
    });
})->uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);
