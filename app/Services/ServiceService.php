<?php

namespace App\Services;

use App\Models\Service;
use App\Actions\Service\CreateServiceAction;
use App\Actions\Service\UpdateServiceAction;
use App\Actions\Service\DeleteServiceAction;

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

    /**
     * Atualiza um serviço existente.
     */
    public function update(Service $service, array $data): Service
    {
        return (new UpdateServiceAction())->execute($service, $data);
    }

    /**
     * Exclui um serviço.
     */
    public function delete(Service $service): void
    {
        (new DeleteServiceAction())->execute($service);
    }
}
