<?php

namespace App\Services;

use App\Models\Service;
use App\Actions\Service\CreateServiceAction;

class ServiceService
{
    /**
     * Cria um novo serviço.
     */
    public function create(array $data): Service
    {
        return (new CreateServiceAction())->execute($data);
    }

    /**
     * Lista todos os serviços.
     */
    public function all()
    {
        return Service::all();
    }
}
