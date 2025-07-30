<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Client;
use App\Models\Service;
use App\Services\AppointmentService;
use App\Http\Requests\StoreAppointmentRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(AppointmentService $appointmentService)
    {
        $appointments = $appointmentService->all();
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $clients = Client::all();
        $services = Service::all();
        return view('appointments.create', compact('clients', 'services'));
    }

    public function store(StoreAppointmentRequest $request, AppointmentService $appointmentService)
    {
        $appointment = $appointmentService->create($request->validated());
        if (!$appointment) {
            return back()->with('error', 'Horário já reservado.');
        }
        return redirect()->route('appointments.index')->with('success', 'Agendamento realizado com sucesso!');
    }

    public function edit(Appointment $appointment)
    {
        $clients = Client::all();
        $services = Service::all();
        return view('appointments.edit', compact('appointment', 'clients', 'services'));
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
