<?php

namespace App\Actions\Client;

use App\Models\Client;

class CreateClientAction
{
    /**
     * Executa a ação de criar um novo cliente.
     */
    public function execute(array $data): Client
    {
        // Aqui pode adicionar lógica extra, como eventos, validações customizadas, etc.
        return Client::create($data);
    }
}
