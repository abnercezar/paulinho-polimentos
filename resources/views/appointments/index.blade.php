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
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Agendamentos</h1>
    <button @click="openCreate = true; createForm = { client_id: '', service_id: '', scheduled_at: '', status: 'pendente' }; $nextTick(() => { $refs.client_id.value = ''; $refs.service_id.value = ''; $refs.scheduled_at.value = ''; $refs.status.value = 'pendente'; })" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition mb-4 inline-block">Novo Agendamento</button>
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
    <button @click="openEdit = {{ $appointment->id }}; $nextTick(() => {
        $refs['edit_client_id_' + {{ $appointment->id }}].value = '{{ $appointment->client_id }}';
        $refs['edit_service_id_' + {{ $appointment->id }}].value = '{{ $appointment->service_id }}';
        $refs['edit_scheduled_at_' + {{ $appointment->id }}].value = '{{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('Y-m-d\TH:i') }}';
        $refs['edit_status_' + {{ $appointment->id }}].value = '{{ $appointment->status }}';
    })" class="px-2 py-1 bg-yellow-400 text-gray-900 rounded text-xs hover:bg-yellow-500 transition">Editar</button>
                            <button @click="openDelete = {{ $appointment->id }}" class="px-2 py-1 bg-red-500 text-white rounded text-xs hover:bg-red-600 transition">Excluir</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <x-pagination :paginator="$appointments" />

    <!-- Modal Criar Agendamento -->
    <div x-show="openCreate" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40" style="display: none;">
        <div class="bg-white rounded-xl shadow-xl p-8 w-full max-w-md relative">
            <button @click="openCreate = false" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700">&times;</button>
            <h2 class="text-xl font-bold mb-4">Novo Agendamento</h2>
            <form action="{{ route('appointments.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="client_id" class="block text-sm font-medium text-gray-700">Cliente</label>
                    <select name="client_id" id="client_id" x-ref="client_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required x-model="createForm.client_id">
                        <option value="">Selecione</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="service_id" class="block text-sm font-medium text-gray-700">Serviço</label>
                    <select name="service_id" id="service_id" x-ref="service_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required x-model="createForm.service_id">
                        <option value="">Selecione</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="scheduled_at" class="block text-sm font-medium text-gray-700">Data e Hora</label>
                    <input type="datetime-local" name="scheduled_at" id="scheduled_at" x-ref="scheduled_at" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required x-model="createForm.scheduled_at">
                </div>
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" x-ref="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required x-model="createForm.status">
                        <option value="pendente">Pendente</option>
                        <option value="confirmado">Confirmado</option>
                        <option value="cancelado">Cancelado</option>
                        <option value="concluido">Concluído</option>
                    </select>
                </div>
                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" @click="openCreate = false" class="px-4 py-2 bg-gray-200 rounded">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    @foreach($appointments as $appointment)
        <div x-show="openEdit === {{ $appointment->id }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40" style="display: none;">
            <div class="bg-white rounded-xl shadow-xl p-8 w-full max-w-md relative">
                <button @click="openEdit = null" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700">&times;</button>
                <h2 class="text-xl font-bold mb-4">Editar Agendamento</h2>
                <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="edit_client_id_{{ $appointment->id }}" class="block text-sm font-medium text-gray-700">Cliente</label>
                        <select name="client_id" id="edit_client_id_{{ $appointment->id }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="">Selecione</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ $appointment->client_id == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="edit_service_id_{{ $appointment->id }}" class="block text-sm font-medium text-gray-700">Serviço</label>
                        <select name="service_id" id="edit_service_id_{{ $appointment->id }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="">Selecione</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}" {{ $appointment->service_id == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="edit_scheduled_at_{{ $appointment->id }}" class="block text-sm font-medium text-gray-700">Data e Hora</label>
                        <input type="datetime-local" name="scheduled_at" id="edit_scheduled_at_{{ $appointment->id }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required value="{{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('Y-m-d\TH:i') }}">
                    </div>
                    <div class="mb-4">
                        <label for="edit_status_{{ $appointment->id }}" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="edit_status_{{ $appointment->id }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="pendente" {{ $appointment->status == 'pendente' ? 'selected' : '' }}>Pendente</option>
                            <option value="confirmado" {{ $appointment->status == 'confirmado' ? 'selected' : '' }}>Confirmado</option>
                            <option value="cancelado" {{ $appointment->status == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                            <option value="concluido" {{ $appointment->status == 'concluido' ? 'selected' : '' }}>Concluído</option>
                        </select>
                    </div>
                    <div class="flex justify-end gap-2 mt-6">
                        <button type="button" @click="openEdit = null" class="px-4 py-2 bg-gray-200 rounded">Cancelar</button>
                        <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    <!-- Modal Deletar Agendamento -->
    <template x-for="appointment in {{ Js::from($appointments->pluck('id')) }}" :key="appointment">
        <div x-show="openDelete === appointment" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40" style="display: none;">
            <div class="bg-white rounded-xl shadow-xl p-8 w-full max-w-md relative">
                <button @click="openDelete = null" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700">&times;</button>
                <h2 class="text-xl font-bold mb-4 text-red-600">Excluir Agendamento</h2>
                <p class="mb-6">Tem certeza que deseja excluir este agendamento?</p>
                <form :action="'{{ url('appointments') }}/' + appointment" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex justify-end gap-2 mt-6">
                        <button type="button" @click="openDelete = null" class="px-4 py-2 bg-gray-200 rounded">Cancelar</button>
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Excluir</button>
                    </div>
                </form>
            </div>
        </div>
    </template>
</div>
@endsection
