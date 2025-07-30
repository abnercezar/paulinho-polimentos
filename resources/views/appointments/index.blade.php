@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agendamentos</h1>
    <a href="{{ route('appointments.create') }}" class="btn btn-primary mb-3">Novo Agendamento</a>
    <table class="table">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Serviço</th>
                <th>Data e Hora</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->client->name }}</td>
                    <td>{{ $appointment->service->name }}</td>
                    <td>{{ date('d/m/Y H:i', strtotime($appointment->scheduled_at)) }}</td>
                    <td>{{ $appointment->status ?? 'Pendente' }}</td>
                    <td>
                        <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este agendamento?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
