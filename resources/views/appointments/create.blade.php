@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Novo Agendamento</h1>
    <form action="{{ route('appointments.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="client_id" class="form-label">Cliente</label>
            <select name="client_id" id="client_id" class="form-control" required>
                <option value="">Selecione</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="service_id" class="form-label">Serviço</label>
            <select name="service_id" id="service_id" class="form-control" required>
                <option value="">Selecione</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="scheduled_at" class="form-label">Data e Hora</label>
            <input type="datetime-local" name="scheduled_at" id="scheduled_at" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
