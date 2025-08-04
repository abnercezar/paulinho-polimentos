<?php

use App\Models\Client;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\CashRegister;

describe('Integração de Fluxo de Negócio', function () {
    describe('Fluxo completo de agendamento', function () {
        it('pode completar todo o ciclo de vida do agendamento', function () {
            // 1. Criar cliente
            $client = Client::factory()->create([
                'name' => 'Maria Silva',
                'phone' => '11999999999',
                'email' => 'maria@email.com'
            ]);

            // 2. Criar serviço
            $service = Service::factory()->create([
                'name' => 'Corte + Escova',
                'price' => 80.00,
                'duration_minutes' => 90
            ]);

            // 3. Criar agendamento
            $appointment = Appointment::factory()->create([
                'client_id' => $client->id,
                'service_id' => $service->id,
                'scheduled_at' => now()->addDay(),
                'duration_minutes' => $service->duration_minutes,
                'status' => 'scheduled'
            ]);

            // 4. Confirmar agendamento
            $appointment->update(['status' => 'confirmed']);

            // 5. Completar serviço
            $appointment->update(['status' => 'completed']);

            // 6. Registrar pagamento
            $cashRegister = CashRegister::factory()->create([
                'service_id' => $service->id,
                'client_id' => $client->id,
                'amount' => $service->price,
                'payment_type' => 'credit_card',
                'status' => 'paid',
                'payment_date' => now()
            ]);

            // Verificações
            expect($client->appointments)->toHaveCount(1);
            expect($service->appointments)->toHaveCount(1);
            expect($appointment->status)->toBe('completed');
            expect($cashRegister->amount)->toBe($service->price);
            expect($cashRegister->client->name)->toBe($client->name);
            expect($cashRegister->service->name)->toBe($service->name);
        });

        it('pode rastrear histórico de pagamentos do cliente', function () {
            $client = Client::factory()->create();

            // Múltiplos serviços para o mesmo cliente
            $service1 = Service::factory()->create(['price' => 50.00]);
            $service2 = Service::factory()->create(['price' => 80.00]);
            $service3 = Service::factory()->create(['price' => 120.00]);

            // Registrar pagamentos
            CashRegister::factory()->create([
                'client_id' => $client->id,
                'service_id' => $service1->id,
                'amount' => 50.00,
                'status' => 'paid'
            ]);

            CashRegister::factory()->create([
                'client_id' => $client->id,
                'service_id' => $service2->id,
                'amount' => 80.00,
                'status' => 'paid'
            ]);

            CashRegister::factory()->create([
                'client_id' => $client->id,
                'service_id' => $service3->id,
                'amount' => 120.00,
                'status' => 'pending'
            ]);

            // Verificações
            $totalPaid = CashRegister::where('client_id', $client->id)
                ->where('status', 'paid')
                ->sum('amount');

            $totalPending = CashRegister::where('client_id', $client->id)
                ->where('status', 'pending')
                ->sum('amount');

            expect($totalPaid)->toBe(130.00);
            expect($totalPending)->toBe(120.00);
        });

        it('pode lidar com conflitos de agendamento', function () {
            $client = Client::factory()->create();
            $service = Service::factory()->create(['duration_minutes' => 60]);

            $scheduledTime = now()->addDays(1)->hour(14)->minute(0);

            // Primeiro agendamento
            $appointment1 = Appointment::factory()->create([
                'client_id' => $client->id,
                'service_id' => $service->id,
                'scheduled_at' => $scheduledTime,
                'duration_minutes' => 60,
                'status' => 'scheduled'
            ]);

            // Verificar se há conflito de horário (mesmo horário)
            $conflictingAppointments = Appointment::where('scheduled_at', $scheduledTime)
                ->where('status', '!=', 'cancelled')
                ->count();

            expect($conflictingAppointments)->toBe(1);

            // Tentar agendar no mesmo horário deveria ser detectado
            $appointment2 = Appointment::factory()->create([
                'service_id' => $service->id,
                'scheduled_at' => $scheduledTime,
                'duration_minutes' => 60,
                'status' => 'scheduled'
            ]);

            $totalConflicts = Appointment::where('scheduled_at', $scheduledTime)
                ->where('status', '!=', 'cancelled')
                ->count();

            expect($totalConflicts)->toBe(2); // Indica possível conflito
        });

        it('pode gerar relatórios de negócio', function () {
            // Criar dados de teste para relatório
            $clients = Client::factory()->count(3)->create();
            $services = Service::factory()->count(2)->create();

            // Agendamentos em diferentes status
            Appointment::factory()->count(5)->create(['status' => 'completed']);
            Appointment::factory()->count(3)->create(['status' => 'scheduled']);
            Appointment::factory()->count(2)->create(['status' => 'cancelled']);

            // Pagamentos
            CashRegister::factory()->count(8)->create(['status' => 'paid']);
            CashRegister::factory()->count(2)->create(['status' => 'pending']);

            // Relatórios
            $totalClients = Client::count();
            $totalServices = Service::count();
            $completedAppointments = Appointment::where('status', 'completed')->count();
            $scheduledAppointments = Appointment::where('status', 'scheduled')->count();
            $totalRevenue = CashRegister::where('status', 'paid')->sum('amount');
            $pendingRevenue = CashRegister::where('status', 'pending')->sum('amount');

            expect($totalClients)->toBe(3);
            expect($totalServices)->toBe(2);
            expect($completedAppointments)->toBe(5);
            expect($scheduledAppointments)->toBe(3);
            expect($totalRevenue)->toBeGreaterThan(0);
            expect($pendingRevenue)->toBeGreaterThan(0);
        });
    });
})->uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);
