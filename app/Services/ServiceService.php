<?php

namespace App\Services;

use App\Models\Service;

class ServiceService
{
    /**
     * Cria um novo serviço.
     */
    public function create(array $data): Service
    {
        return Service::create($data);
    }

    /**
     * Lista todos os serviços.
     */
    public function all()
    {
        return Service::all();
    }

    /**
     * Lista todos os serviços paginados.
     */
    public function getPaginated(int $perPage = 15)
    {
        return Service::paginate($perPage);
    }

    /**
     * Atualiza um serviço existente.
     */
    public function update(Service $service, array $data): Service
    {
        $service->update($data);
        return $service;
    }

    /**
     * Exclui um serviço.
     */
    public function delete(Service $service): void
    {
        $service->delete();
    }
}
