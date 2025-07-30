<?php

namespace App\Services;

use App\Models\Appointment;
use App\Actions\Appointment\CreateAppointmentAction;
use App\Actions\Appointment\UpdateAppointmentAction;
use App\Actions\Appointment\DeleteAppointmentAction;

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
     * Lista todos os agendamentos.
     */
    public function all($perPage = 15)
    {
        return Appointment::with(['client', 'service'])->paginate($perPage);
    }

    /**
     * Atualiza um agendamento existente.
     */
    public function update(Appointment $appointment, array $data): Appointment
    {
        return (new UpdateAppointmentAction())->execute($appointment, $data);
    }

    /**
     * Exclui um agendamento.
     */
    public function delete(Appointment $appointment): void
    {
        (new DeleteAppointmentAction())->execute($appointment);
    }
}
