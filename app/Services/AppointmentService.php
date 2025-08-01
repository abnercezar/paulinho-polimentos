<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Client;
use App\Models\Service;
use App\Actions\Appointment\CreateAppointmentAction;

class AppointmentService
{
    /**
     * Cria um novo agendamento usando a Action.
     */
    public function create(array $data): ?Appointment
    {
        return (new CreateAppointmentAction())->execute($data);
    }

    /**
     * Lista todos os agendamentos paginados.
     */
    public function getPaginated(int $perPage = 15)
    {
        return Appointment::with(['client', 'service'])
            ->orderBy('scheduled_at')
            ->orderBy('created_at')
            ->paginate($perPage);
    }

    /**
     * Lista todos os agendamentos.
     */
    public function all($perPage = 15)
    {
        return Appointment::with(['client', 'service'])->paginate($perPage);
    }

    /**
     * Obtém os dados necessários para os formulários.
     */
    public function getFormData(): array
    {
        return [
            'clients' => Client::all(),
            'services' => Service::all(),
        ];
    }

    /**
     * Atualiza um agendamento existente.
     */
    public function update(Appointment $appointment, array $data): Appointment
    {
        $appointment->update($data);
        return $appointment;
    }

    /**
     * Exclui um agendamento.
     */
    public function delete(Appointment $appointment): void
    {
        $appointment->delete();
    }
}
