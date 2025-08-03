<?php

namespace App\Services;

use App\Models\Service;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
     *
     * @throws \InvalidArgumentException se há agendamentos ou registros de caixa vinculados
     */
    public function delete(Service $service): void
    {
        // Verifica se há agendamentos vinculados
        if ($service->appointments()->exists()) {
            throw new \InvalidArgumentException('Não é possível excluir este serviço pois há agendamentos vinculados a ele.');
        }

        // Verifica se há registros de caixa vinculados
        if ($service->cashRegisters()->exists()) {
            throw new \InvalidArgumentException('Não é possível excluir este serviço pois há registros de caixa vinculados a ele.');
        }

        $service->delete();
    }
}
