<?php

namespace App\Services;

use App\Models\Appointment;
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
     * Lista todos os agendamentos.
     */
    public function all()
    {
        return Appointment::with(['client', 'service'])->get();
    }
}
