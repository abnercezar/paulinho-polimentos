@extends('layouts.app')

@section('content')

<div x-data="{
    openCreate: false,
    openEdit: null,
    openDelete: null,
    createForm: {
        client_id: '',
        service_id: '',
        scheduled_at: '',
        status: 'pendente'
    }
}">
 <div class="bg-white rounded shadow p-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Agendamentos</h1>
    <button @click="openCreate = true; createForm = { client_id: '', service_id: '', scheduled_at: '', status: 'pendente' }; $nextTick(() => { $refs.client_id.value = ''; $refs.service_id.value = ''; $refs.scheduled_at.value = ''; $refs.status.value = 'pendente'; })" class="px-4 py-2 bg-blue-100 text-blue-800 rounded hover:bg-blue-200 transition mb-4 inline-block border border-blue-200">Novo Agendamento</button>
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
                    <tr class="border-b {{ $loop->odd ? 'bg-gray-100' : 'bg-white' }}">
                        <td class="px-3 py-2">{{ $appointment->client->name }}</td>
                        <td class="px-3 py-2">{{ $appointment->service->name }}</td>
                        <td class="px-3 py-2">{{ date('d/m/Y H:i', strtotime($appointment->scheduled_at)) }}</td>
                        <td class="px-3 py-2">
                            @php
                                $statusColors = [
                                    'pendente' => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                                    'confirmado' => 'bg-green-100 text-green-800 border border-green-200',
                                    'cancelado' => 'bg-red-100 text-red-800 border border-red-200',
                                    'concluido' => 'bg-blue-100 text-blue-800 border border-blue-200',
                                ];
                            @endphp
                            <span class="px-2 py-1 rounded text-xs {{ $statusColors[$appointment->status] ?? 'bg-gray-300 text-gray-800' }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </td>
                        <td class="px-3 py-2 flex gap-2">
    <button @click="openEdit = {{ $appointment->id }}; $nextTick(() => {
        $refs['edit_client_id_' + {{ $appointment->id }}].value = '{{ $appointment->client_id }}';
        $refs['edit_service_id_' + {{ $appointment->id }}].value = '{{ $appointment->service_id }}';
        $refs['edit_scheduled_at_' + {{ $appointment->id }}].value = '{{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('Y-m-d\TH:i') }}';
        $refs['edit_status_' + {{ $appointment->id }}].value = '{{ $appointment->status }}';
    })" class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs hover:bg-yellow-200 transition border border-yellow-200">Editar</button>
                            <button @click="openDelete = {{ $appointment->id }}" class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs hover:bg-red-200 transition border border-red-200">Excluir</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <x-pagination :paginator="$appointments" />

    <x-components.modals.modal-create-appointment />

    <x-components.modals.modal-edit-appointment />

    <x-components.modals.modal-delete-appointment />
    </div>
</div>
@endsection
