<?php

use App\Models\CashRegister;
use App\Models\Client;
use App\Models\Service;

describe('Model Caixa', function () {
    it('pode ser criado com dados válidos', function () {
        $client = Client::factory()->create();
        $service = Service::factory()->create();

        $cashRegister = CashRegister::factory()->create([
            'service_id' => $service->id,
            'client_id' => $client->id,
            'amount' => 150.00,
            'payment_type' => 'credit_card',
            'status' => 'paid',
            'payment_date' => now()
        ]);

        expect($cashRegister->service_id)->toBe($service->id);
        expect($cashRegister->client_id)->toBe($client->id);
        expect($cashRegister->amount)->toBe(150.00);
        expect($cashRegister->payment_type)->toBe('credit_card');
        expect($cashRegister->status)->toBe('paid');
    });

    it('possui atributos preenchíveis', function () {
        $fillable = ['service_id', 'client_id', 'amount', 'payment_type', 'status', 'payment_date'];

        expect((new CashRegister())->getFillable())->toBe($fillable);
    });

    it('pertence a um serviço', function () {
        $cashRegister = CashRegister::factory()->create();

        expect($cashRegister->service())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class);
        expect($cashRegister->service)->toBeInstanceOf(Service::class);
    });

    it('pertence a um cliente', function () {
        $cashRegister = CashRegister::factory()->create();

        expect($cashRegister->client())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class);
        expect($cashRegister->client)->toBeInstanceOf(Client::class);
    });

    it('valor deve ser numérico', function () {
        $cashRegister = CashRegister::factory()->create(['amount' => '199.99']);

        expect($cashRegister->amount)->toBeNumeric();
    });

    it('pode rastrear informações de pagamento', function () {
        $client = Client::factory()->create(['name' => 'Ana Santos']);
        $service = Service::factory()->create(['name' => 'Escova']);

        $cashRegister = CashRegister::factory()->create([
            'client_id' => $client->id,
            'service_id' => $service->id,
            'amount' => 80.00,
            'payment_type' => 'pix'
        ]);

        expect($cashRegister->client->name)->toBe('Ana Santos');
        expect($cashRegister->service->name)->toBe('Escova');
        expect($cashRegister->amount)->toBe(80.00);
        expect($cashRegister->payment_type)->toBe('pix');
    });
})->uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);
