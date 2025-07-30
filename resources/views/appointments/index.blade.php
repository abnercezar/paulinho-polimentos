@extends('layouts.app')

@section('content')
<div class="bg-white rounded shadow p-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Agendamentos</h1>
    <a href="{{ route('appointments.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition mb-4 inline-block">Novo Agendamento</a>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-700">Cliente</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-700">Serviço</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-700">Data e Hora</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-700">Status</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-700">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment)
                    <tr class="border-b">
                        <td class="px-3 py-2">{{ $appointment->client->name }}</td>
                        <td class="px-3 py-2">{{ $appointment->service->name }}</td>
                        <td class="px-3 py-2">{{ date('d/m/Y H:i', strtotime($appointment->scheduled_at)) }}</td>
                        <td class="px-3 py-2">
                            @php
                                $statusColors = [
                                    'pendente' => 'bg-yellow-400 text-gray-800',
                                    'confirmado' => 'bg-green-500 text-white',
                                    'cancelado' => 'bg-red-500 text-white',
                                    'concluido' => 'bg-blue-500 text-white',
                                ];
                            @endphp
                            <span class="px-2 py-1 rounded text-xs {{ $statusColors[$appointment->status] ?? 'bg-gray-300 text-gray-800' }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </td>
                        <td class="px-3 py-2 flex gap-2">
                            <a href="{{ route('appointments.edit', $appointment) }}" class="px-2 py-1 bg-yellow-400 text-gray-900 rounded text-xs hover:bg-yellow-500 transition">Editar</a>
                            <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este agendamento?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded text-xs hover:bg-red-600 transition">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <x-pagination :paginator="$appointments" />
</div>
@endsection
