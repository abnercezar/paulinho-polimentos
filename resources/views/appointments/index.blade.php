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
 <div class="bg-white rounded-lg shadow-sm border p-4 md:p-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <h1 class="text-xl md:text-2xl font-bold text-gray-800 mb-3 sm:mb-0">Agendamentos</h1>
        <button @click="openCreate = true; createForm = { client_id: '', service_id: '', scheduled_at: '', status: 'pendente' }; $nextTick(() => { $refs.client_id.value = ''; $refs.service_id.value = ''; $refs.scheduled_at.value = ''; $refs.status.value = 'pendente'; })"
                class="mobile-btn w-full sm:w-auto px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors shadow-sm font-medium">
            <span class="sm:hidden">+ Novo Agendamento</span>
            <span class="hidden sm:inline">Novo Agendamento</span>
        </button>
    </div>

    <!-- Mobile view (cards) -->
    <div class="md:hidden space-y-3">
        @foreach ($appointments as $appointment)
            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                <div class="flex justify-between items-start mb-3">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900 truncate">{{ $appointment->client->name }}</h3>
                        <p class="text-sm text-gray-600 truncate">{{ $appointment->service->name }}</p>
                        <p class="text-sm text-gray-600">{{ date('d/m/Y H:i', strtotime($appointment->scheduled_at)) }}</p>
                    </div>
                    <div class="ml-3">
                        @php
                            $statusColors = [
                                'pendente' => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                                'confirmado' => 'bg-green-100 text-green-800 border border-green-200',
                                'cancelado' => 'bg-red-100 text-red-800 border border-red-200',
                                'concluido' => 'bg-blue-100 text-blue-800 border border-blue-200',
                            ];
                        @endphp
                        <span class="px-2 py-1 rounded-full text-xs font-medium {{ $statusColors[$appointment->status] ?? 'bg-gray-300 text-gray-800' }}">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button @click="openEdit = {{ $appointment->id }}; $nextTick(() => {
                                $refs.edit_client_id_{{ $appointment->id }}.value = '{{ $appointment->client_id }}';
                                $refs.edit_service_id_{{ $appointment->id }}.value = '{{ $appointment->service_id }}';
                                $refs.edit_scheduled_at_{{ $appointment->id }}.value = '{{ date('Y-m-d\TH:i', strtotime($appointment->scheduled_at)) }}';
                                $refs.edit_status_{{ $appointment->id }}.value = '{{ $appointment->status }}';
                            })"
                            class="mobile-btn flex-1 px-3 py-2 bg-yellow-100 text-yellow-800 rounded-md text-sm hover:bg-yellow-200 transition-colors border border-yellow-200 font-medium">
                        Editar
                    </button>
                    <button @click="openDelete = {{ $appointment->id }}"
                            class="mobile-btn flex-1 px-3 py-2 bg-red-100 text-red-800 rounded-md text-sm hover:bg-red-200 transition-colors border border-red-200 font-medium">
                        Excluir
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Desktop view (table) -->
    <div class="hidden md:block">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Cliente</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Serviço</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Data e Hora</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($appointments as $appointment)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 text-sm text-gray-900">{{ $appointment->client->name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600">{{ $appointment->service->name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600">{{ date('d/m/Y H:i', strtotime($appointment->scheduled_at)) }}</td>
                            <td class="px-4 py-3">
                                @php
                                    $statusColors = [
                                        'pendente' => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                                        'confirmado' => 'bg-green-100 text-green-800 border border-green-200',
                                        'cancelado' => 'bg-red-100 text-red-800 border border-red-200',
                                        'concluido' => 'bg-blue-100 text-blue-800 border border-blue-200',
                                    ];
                                @endphp
                                <span class="px-2 py-1 rounded-full text-xs font-medium {{ $statusColors[$appointment->status] ?? 'bg-gray-300 text-gray-800' }}">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex gap-2">
                                    <button @click="openEdit = {{ $appointment->id }}; $nextTick(() => {
                                                $refs['edit_client_id_' + {{ $appointment->id }}].value = '{{ $appointment->client_id }}';
                                                $refs['edit_service_id_' + {{ $appointment->id }}].value = '{{ $appointment->service_id }}';
                                                $refs['edit_scheduled_at_' + {{ $appointment->id }}].value = '{{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('Y-m-d\TH:i') }}';
                                                $refs['edit_status_' + {{ $appointment->id }}].value = '{{ $appointment->status }}';
                                            })"
                                            class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-md text-sm hover:bg-yellow-200 transition-colors border border-yellow-200 font-medium">
                                        Editar
                                    </button>
                                    <button @click="openDelete = {{ $appointment->id }}"
                                            class="px-3 py-1 bg-red-100 text-red-800 rounded-md text-sm hover:bg-red-200 transition-colors border border-red-200 font-medium">
                                        Excluir
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <x-pagination :paginator="$appointments" />

    <x-modals.modal-create-appointment :clients="$clients" :services="$services" />

    <x-modals.modal-edit-appointment :appointments="$appointments" :clients="$clients" :services="$services" />

    <x-modals.modal-delete-appointment :appointments="$appointments" />
    </div>
</div>
@endsection
