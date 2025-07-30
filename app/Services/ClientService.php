<?php

namespace App\Services;

use App\Models\Client;
use App\Actions\Client\CreateClientAction;

class ClientService
{
    /**
     * Cria um novo cliente.
     */
    public function create(array $data): Client
    {
        return (new CreateClientAction())->execute($data);
    }

    /**
     * Lista todos os clientes.
     */
    public function all()
    {
        return Client::all();
    }
}
