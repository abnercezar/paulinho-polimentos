@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Agendamento</h1>
    <form action="{{ route('appointments.update', $appointment) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="client_id" class="form-label">Cliente</label>
            <select name="client_id" id="client_id" class="form-control" required>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ $appointment->client_id == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="service_id" class="form-label">Serviço</label>
            <select name="service_id" id="service_id" class="form-control" required>
                @foreach($services as $service)
                    <option value="{{ $service->id }}" {{ $appointment->service_id == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="scheduled_at" class="form-label">Data e Hora</label>
            <input type="datetime-local" name="scheduled_at" id="scheduled_at" class="form-control" value="{{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('Y-m-d\TH:i') }}" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="pendente" {{ $appointment->status == 'pendente' ? 'selected' : '' }}>Pendente</option>
                <option value="confirmado" {{ $appointment->status == 'confirmado' ? 'selected' : '' }}>Confirmado</option>
                <option value="cancelado" {{ $appointment->status == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                <option value="concluido" {{ $appointment->status == 'concluido' ? 'selected' : '' }}>Concluído</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Atualizar</button>
        <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
