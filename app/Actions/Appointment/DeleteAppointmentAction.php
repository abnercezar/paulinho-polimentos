<?php

namespace App\Actions\Appointment;

use App\Models\Appointment;

class DeleteAppointmentAction
{
    /**
     * Exclui um agendamento.
     */
    public function execute(Appointment $appointment): void
    {
        $appointment->delete();
    }
}
