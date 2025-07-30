<?php

namespace App\Actions\Appointment;

use App\Models\Appointment;

class UpdateAppointmentAction
{
    /**
     * Atualiza um agendamento existente.
     */
    public function execute(Appointment $appointment, array $data): Appointment
    {
        $appointment->update($data);
        return $appointment;
    }
}
