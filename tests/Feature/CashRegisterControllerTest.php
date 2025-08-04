<?php

use App\Models\CashRegister;
use App\Models\Client;
use App\Models\Service;

describe('Controller Caixa', function () {
    beforeEach(function () {
        $this->client = Client::factory()->create();
        $this->service = Service::factory()->create(['price' => 100.00]);
    });

    describe('Operações do Caixa', function () {
        it('pode criar uma nova entrada no caixa', function () {
            $cashRegisterData = [
                'service_id' => $this->service->id,
                'client_id' => $this->client->id,
                'amount' => 100.00,
                'payment_type' => 'credit_card',
                'status' => 'paid',
                'payment_date' => now()->format('Y-m-d')
            ];

            $response = $this->post('/cash-registers', $cashRegisterData);

            $response->assertRedirect();
            $this->assertDatabaseHas('cash_registers', [
                'service_id' => $this->service->id,
                'client_id' => $this->client->id,
                'amount' => 100.00,
                'payment_type' => 'credit_card'
            ]);
        });

        it('valida campos obrigatórios', function ($field) {
            $cashRegisterData = [
                'service_id' => $this->service->id,
                'client_id' => $this->client->id,
                'amount' => 100.00,
                'payment_type' => 'pix',
                'status' => 'paid'
            ];
            unset($cashRegisterData[$field]);

            $response = $this->post('/cash-registers', $cashRegisterData);

            $response->assertSessionHasErrors($field);
        })->with(['service_id', 'client_id', 'amount', 'payment_type']);

        it('valida que valor é numérico', function () {
            $cashRegisterData = [
                'service_id' => $this->service->id,
                'client_id' => $this->client->id,
                'amount' => 'não-numérico',
                'payment_type' => 'cash',
                'status' => 'paid'
            ];

            $response = $this->post('/cash-registers', $cashRegisterData);

            $response->assertSessionHasErrors('amount');
        });

        it('valida que tipo de pagamento é válido', function ($paymentType) {
            $cashRegisterData = [
                'service_id' => $this->service->id,
                'client_id' => $this->client->id,
                'amount' => 100.00,
                'payment_type' => $paymentType,
                'status' => 'paid'
            ];

            $response = $this->post('/cash-registers', $cashRegisterData);

            $response->assertRedirect();
        })->with(['cash', 'credit_card', 'debit_card', 'pix']);

        it('pode listar entradas do caixa', function () {
            CashRegister::factory()->count(5)->create();

            $response = $this->get('/cash-registers');

            $response->assertStatus(200);
            $response->assertViewHas('cashRegisters');
        });

        it('pode atualizar status do pagamento', function () {
            $cashRegister = CashRegister::factory()->create([
                'status' => 'pending',
                'amount' => 150.00
            ]);

            $updateData = [
                'service_id' => $cashRegister->service_id,
                'client_id' => $cashRegister->client_id,
                'amount' => 150.00,
                'payment_type' => $cashRegister->payment_type,
                'status' => 'paid',
                'payment_date' => now()->format('Y-m-d')
            ];

            $response = $this->put("/cash-registers/{$cashRegister->id}", $updateData);

            $response->assertRedirect();
            $this->assertDatabaseHas('cash_registers', [
                'id' => $cashRegister->id,
                'status' => 'paid'
            ]);
        });

        it('pode deletar entrada do caixa', function () {
            $cashRegister = CashRegister::factory()->create();

            $response = $this->delete("/cash-registers/{$cashRegister->id}");

            $response->assertRedirect();
            $this->assertDatabaseMissing('cash_registers', [
                'id' => $cashRegister->id
            ]);
        });

        it('calcula totais corretamente', function () {
            CashRegister::factory()->create(['amount' => 100.00, 'status' => 'paid']);
            CashRegister::factory()->create(['amount' => 150.00, 'status' => 'paid']);
            CashRegister::factory()->create(['amount' => 75.00, 'status' => 'pending']);

            $paidTotal = CashRegister::where('status', 'paid')->sum('amount');
            $pendingTotal = CashRegister::where('status', 'pending')->sum('amount');

            expect($paidTotal)->toBe(250.00);
            expect($pendingTotal)->toBe(75.00);
        });

        it('mostra histórico de pagamentos para cliente', function () {
            $client = Client::factory()->create();
            CashRegister::factory()->count(3)->create(['client_id' => $client->id]);

            $payments = CashRegister::where('client_id', $client->id)->get();

            expect($payments)->toHaveCount(3);
            expect($payments->first()->client_id)->toBe($client->id);
        });
    });
})->uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);
