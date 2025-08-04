<?php

namespace App\Actions\Appointment;

use App\Models\Appointment;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

        // Verificação de conflito compatível com MySQL e SQLite
        $conflict = Appointment::where(function ($query) use ($start, $end) {
            $query->where(function ($q) use ($start, $end) {
                // Agendamento existente que começa antes do fim do novo agendamento
                // e termina depois do início do novo agendamento
                $q->where('scheduled_at', '<', $end)
                    ->whereRaw($this->getDateAddQuery(), [$start]);
            });
        })->exists();

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

    /**
     * Retorna a query de adição de data apropriada para o banco de dados em uso
     */
    private function getDateAddQuery(): string
    {
        $connection = DB::connection()->getDriverName();

        return match ($connection) {
            'mysql' => 'DATE_ADD(scheduled_at, INTERVAL duration_minutes MINUTE) > ?',
            'sqlite' => 'datetime(scheduled_at, "+" || duration_minutes || " minutes") > ?',
            default => 'DATE_ADD(scheduled_at, INTERVAL duration_minutes MINUTE) > ?', // fallback para MySQL
        };
    }
}
