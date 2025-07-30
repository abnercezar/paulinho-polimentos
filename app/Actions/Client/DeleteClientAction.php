<?php

namespace App\Actions\Client;

use App\Models\Client;

class DeleteClientAction
{
    /**
     * Exclui um cliente.
     */
    public function execute(Client $client): void
    {
        $client->delete();
    }
}
