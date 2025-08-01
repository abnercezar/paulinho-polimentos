<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Services\AppointmentService;
use App\Http\Requests\StoreAppointmentRequest;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(AppointmentService $appointmentService)
    {
        $appointments = $appointmentService->getPaginated(10);
        $formData = $appointmentService->getFormData();
        
        return view('appointments.index', [
            'appointments' => $appointments,
            'clients' => $formData['clients'],
            'services' => $formData['services'],
        ]);
    }

    public function create(AppointmentService $appointmentService)
    {
        $formData = $appointmentService->getFormData();
        
        return view('appointments.create', [
            'clients' => $formData['clients'],
            'services' => $formData['services'],
        ]);
    }

    public function store(StoreAppointmentRequest $request, AppointmentService $appointmentService)
    {
        $appointment = $appointmentService->create($request->validated());
        if (!$appointment) {
            return back()->with('error', 'Horário já reservado.');
        }
        return redirect()->route('appointments.index')->with('success', 'Agendamento realizado com sucesso!');
    }

    public function edit(Appointment $appointment, AppointmentService $appointmentService)
    {
        $formData = $appointmentService->getFormData();
        
        return view('appointments.edit', [
            'appointment' => $appointment,
            'clients' => $formData['clients'],
            'services' => $formData['services'],
        ]);
    }

    /**
     * Atualiza um agendamento existente.
     */
    public function update(StoreAppointmentRequest $request, Appointment $appointment, AppointmentService $appointmentService)
    {
        $appointmentService->update($appointment, $request->validated());
        return redirect()->route('appointments.index')->with('success', 'Agendamento atualizado com sucesso!');
    }

    /**
     * Exclui um agendamento.
     */
    public function destroy(Appointment $appointment, AppointmentService $appointmentService)
    {
        $appointmentService->delete($appointment);
        return redirect()->route('appointments.index')->with('success', 'Agendamento excluído com sucesso!');
    }
}
