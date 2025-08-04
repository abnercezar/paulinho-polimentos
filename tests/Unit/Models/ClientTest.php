<?php

use App\Models\Client;
use App\Models\Appointment;

describe('Model Cliente', function () {
    it('pode ser criado com dados válidos', function () {
        $client = Client::factory()->create([
            'name' => 'João Silva',
            'phone' => '11999999999',
            'email' => 'joao@email.com'
        ]);

        expect($client->name)->toBe('João Silva');
        expect($client->phone)->toBe('11999999999');
        expect($client->email)->toBe('joao@email.com');
    });

    it('possui atributos preenchíveis', function () {
        $fillable = ['name', 'phone', 'email'];

        expect((new Client())->getFillable())->toBe($fillable);
    });

    it('possui relacionamento hasMany com agendamentos', function () {
        $client = Client::factory()->create();

        expect($client->appointments())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class);
    });

    it('pode ter múltiplos agendamentos', function () {
        $client = Client::factory()->create();
        $appointments = Appointment::factory()->count(3)->create(['client_id' => $client->id]);

        expect($client->appointments)->toHaveCount(3);
        expect($client->appointments->first())->toBeInstanceOf(Appointment::class);
    });

    it('requer campo nome', function () {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Client::create([
            'phone' => '11999999999',
            'email' => 'test@email.com'
        ]);
    });
})->uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);
