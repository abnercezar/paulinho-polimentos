<?php

use App\Models\Client;

describe('Model Cliente - Teste Simples', function () {
    it('pode ser criado com dados válidos', function () {
        $client = Client::create([
            'name' => 'João Silva',
            'phone' => '11999999999',
            'email' => 'joao@email.com'
        ]);

        expect($client)->toBeInstanceOf(Client::class);
        expect($client->name)->toBe('João Silva');
        expect($client->phone)->toBe('11999999999');
        expect($client->email)->toBe('joao@email.com');
    });

    it('possui atributos preenchíveis', function () {
        $fillable = ['name', 'phone', 'email'];

        expect((new Client())->getFillable())->toBe($fillable);
    });
})->uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);
