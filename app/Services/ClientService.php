<?php

namespace App\Services;

use App\Models\Client;
use App\Actions\Client\CreateClientAction;
use App\Actions\Client\UpdateClientAction;
use App\Actions\Client\DeleteClientAction;

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

    /**
     * Atualiza um cliente existente.
     */
    public function update(Client $client, array $data): Client
    {
        return (new UpdateClientAction())->execute($client, $data);
    }

    /**
     * Exclui um cliente.
     */
    public function delete(Client $client): void
    {
        (new DeleteClientAction())->execute($client);
    }
}
