<?php

namespace App\Actions\Appointment;

use App\Models\Appointment;
use App\Models\Service;
use Carbon\Carbon;

class CreateAppointmentAction
{
    /**
     * Executa a ação de criar um novo agendamento, incluindo validação de conflito de horário.
     */
    public function execute(array $data): ?Appointment
    {
        $service = Service::findOrFail($data['service_id']);
        $start = Carbon::parse($data['scheduled_at']);
        $end = $start->copy()->addMinutes($service->duration_minutes);

        $conflict = Appointment::where('scheduled_at', '<', $end)
            ->whereRaw('DATE_ADD(scheduled_at, INTERVAL duration_minutes MINUTE) > ?', [$start])
            ->exists();

        if ($conflict) {
            return null;
        }

        return Appointment::create([
            'client_id' => $data['client_id'],
            'service_id' => $data['service_id'],
            'scheduled_at' => $data['scheduled_at'],
            'duration_minutes' => $service->duration_minutes,
        ]);
    }
}
