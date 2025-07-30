<?php

namespace App\Actions\Client;

use App\Models\Client;

class UpdateClientAction
{
    /**
     * Atualiza um cliente existente.
     */
    public function execute(Client $client, array $data): Client
    {
        $client->update($data);
        return $client;
    }
}
