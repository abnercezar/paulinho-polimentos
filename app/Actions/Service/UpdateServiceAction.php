<?php

namespace App\Actions\Service;

use App\Models\Service;

class UpdateServiceAction
{
    /**
     * Atualiza um serviço existente.
     */
    public function execute(Service $service, array $data): Service
    {
        $service->update($data);
        return $service;
    }
}
