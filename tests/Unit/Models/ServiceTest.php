<?php

use App\Models\Service;
use App\Models\Appointment;

describe('Model Serviço', function () {
    it('pode ser criado com dados válidos', function () {
        $service = Service::factory()->create([
            'name' => 'Corte de cabelo',
            'price' => 50.00,
            'duration_minutes' => 30
        ]);

        expect($service->name)->toBe('Corte de cabelo');
        expect($service->price)->toBe(50.00);
        expect($service->duration_minutes)->toBe(30);
    });

    it('possui atributos preenchíveis', function () {
        $fillable = ['name', 'price', 'duration_minutes'];

        expect((new Service())->getFillable())->toBe($fillable);
    });

    it('possui relacionamento hasMany com agendamentos', function () {
        $service = Service::factory()->create();

        expect($service->appointments())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class);
    });

    it('pode ter múltiplos agendamentos', function () {
        $service = Service::factory()->create();
        $appointments = Appointment::factory()->count(2)->create(['service_id' => $service->id]);

        expect($service->appointments)->toHaveCount(2);
        expect($service->appointments->first())->toBeInstanceOf(Appointment::class);
    });

    it('preço deve ser numérico', function () {
        $service = Service::factory()->create(['price' => '99.99']);

        expect($service->price)->toBeNumeric();
    });

    it('duração deve ser inteiro', function () {
        $service = Service::factory()->create(['duration_minutes' => 45]);

        expect($service->duration_minutes)->toBeInt();
    });
})->uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);
