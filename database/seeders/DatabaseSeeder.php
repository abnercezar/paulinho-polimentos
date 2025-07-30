<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Client;
use App\Models\Service;
use App\Models\Appointment;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Criar 20 clientes
        Client::factory()->count(20)->create();
        // Criar 5 serviços
        Service::factory()->count(5)->create();
        // Criar 20 agendamentos
        $clients = \App\Models\Client::pluck('id')->toArray();
        $services = \App\Models\Service::pluck('id')->toArray();
        \App\Models\Appointment::factory()->count(20)->make()->each(function ($appointment) use ($clients, $services) {
            $appointment->client_id = $clients[array_rand($clients)];
            $appointment->service_id = $services[array_rand($services)];
            $appointment->save();
        });
    }
}
