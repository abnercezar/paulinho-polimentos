<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\CashRegister;

class ClientService
{
    /**
     * Cria um novo cliente.
     */
    public function create(array $data): Client
    {
        return Client::create($data);
    }

    /**
     * Lista todos os clientes.
     */
    public function all()
    {
        return Client::all();
    }

    /**
     * Lista todos os clientes paginados.
     */
    public function getPaginated(int $perPage = 15)
    {
        return Client::orderByDesc('created_at')->paginate($perPage);
    }

    /**
     * Obtém os dados necessários para a página index.
     */
    public function getIndexData(): array
    {
        return [
            'services' => Service::all(),
            'appointments' => Appointment::all(),
            'cash_registers' => CashRegister::all(),
        ];
    }

    /**
     * Atualiza um cliente existente.
     */
    public function update(Client $client, array $data): Client
    {
        $client->update($data);
        return $client;
    }

    /**
     * Exclui um cliente.
     */
    public function delete(Client $client): void
    {
        $client->delete();
    }
}
