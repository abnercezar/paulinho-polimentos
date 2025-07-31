@extends('layouts.app')

@section('content')
<div x-data="{ openCreate: false, openEdit: null, openDelete: null, openCreateAppointment: false, openEditAppointment: null, openCreateService: false, openEditService: null, openCreateCashRegister: false, openEditCashRegister: null }">
    <div class="bg-white rounded shadow p-6">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Clientes</h1>
        <button @click="openCreate = true" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition mb-4 inline-block">Novo Cliente</button>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-700">Nome</th>
                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-700">E-mail</th>
                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-700">Telefone</th>
                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-700">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                        <tr class="border-b">
                            <td class="px-3 py-2">{{ $client->name }}</td>
                            <td class="px-3 py-2">{{ $client->email }}</td>
                            <td class="px-3 py-2">{{ $client->phone }}</td>
                            <td class="px-3 py-2 flex gap-2">
                                <button @click="openEdit = {{ $client->id }}" class="px-2 py-1 bg-yellow-400 text-gray-900 rounded text-xs hover:bg-yellow-500 transition">Editar</button>
                                <button @click="openDelete = {{ $client->id }}" class="px-2 py-1 bg-red-500 text-white rounded text-xs hover:bg-red-600 transition">Excluir</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <x-pagination :paginator="$clients" />
    <!-- Modais Alpine.js -->
    <!-- Modal Criar Cliente -->
    <div x-show="openCreate" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40" style="display: none;">
        <div class="bg-white rounded-xl shadow-xl p-8 w-full max-w-md relative">
            <button @click="openCreate = false" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700">&times;</button>
            <h2 class="text-xl font-bold mb-4">Novo Cliente</h2>
            <form action="{{ route('clients.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                    <input type="email" name="email" id="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Telefone</label>
                    <input type="text" name="phone" id="phone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" @click="openCreate = false" class="px-4 py-2 bg-gray-200 rounded">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Editar Cliente -->
    @foreach ($clients as $client)
        <div x-show="openEdit === {{ $client->id }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40" style="display: none;">
            <div class="bg-white rounded-xl shadow-xl p-8 w-full max-w-md relative">
                <button @click="openEdit = null" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700">&times;</button>
                <h2 class="text-xl font-bold mb-4">Editar Cliente</h2>
                <form action="{{ route('clients.update', $client->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="edit_name_{{ $client->id }}" class="block text-sm font-medium text-gray-700">Nome</label>
                        <input type="text" name="name" id="edit_name_{{ $client->id }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required value="{{ $client->name }}">
                    </div>
                    <div class="mb-4">
                        <label for="edit_email_{{ $client->id }}" class="block text-sm font-medium text-gray-700">E-mail</label>
                        <input type="email" name="email" id="edit_email_{{ $client->id }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required value="{{ $client->email }}">
                    </div>
                    <div class="mb-4">
                        <label for="edit_phone_{{ $client->id }}" class="block text-sm font-medium text-gray-700">Telefone</label>
                        <input type="text" name="phone" id="edit_phone_{{ $client->id }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required value="{{ $client->phone }}">
                    </div>
                    <div class="flex justify-end gap-2 mt-6">
                        <button type="button" @click="openEdit = null" class="px-4 py-2 bg-gray-200 rounded">Cancelar</button>
                        <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    <!-- Modal Deletar Cliente -->
    <template x-for="client in {{ Js::from($clients->pluck('id')) }}" :key="client">
        <div x-show="openDelete === client" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40" style="display: none;">
            <div class="bg-white rounded-xl shadow-xl p-8 w-full max-w-md relative">
                <button @click="openDelete = null" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700">&times;</button>
                <h2 class="text-xl font-bold mb-4 text-red-600">Excluir Cliente</h2>
                <p class="mb-6">Tem certeza que deseja excluir este cliente?</p>
                <form :action="'{{ url('clients') }}/' + client" method="POST">
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
    <!-- Modais Agendamentos -->
    <!-- Modal Criar Agendamento -->
    <div x-show="openCreateAppointment" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40" style="display: none;">
        <div class="bg-white rounded-xl shadow-xl p-8 w-full max-w-md relative">
            <button @click="openCreateAppointment = false" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700">&times;</button>
            <h2 class="text-xl font-bold mb-4">Novo Agendamento</h2>
            <form action="{{ route('appointments.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="client_id" class="block text-sm font-medium text-gray-700">Cliente</label>
                    <select name="client_id" id="client_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="service_id" class="block text-sm font-medium text-gray-700">Serviço</label>
                    <select name="service_id" id="service_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="date" class="block text-sm font-medium text-gray-700">Data</label>
                    <input type="date" name="date" id="date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" @click="openCreateAppointment = false" class="px-4 py-2 bg-gray-200 rounded">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Editar Agendamento -->
    <template x-for="appointment in {{ Js::from($appointments->pluck('id')) }}" :key="appointment">
        <div x-show="openEditAppointment === appointment" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40" style="display: none;">
            <div class="bg-white rounded-xl shadow-xl p-8 w-full max-w-md relative">
                <button @click="openEditAppointment = null" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700">&times;</button>
                <h2 class="text-xl font-bold mb-4">Editar Agendamento</h2>
                <form :action="'{{ url('appointments') }}/' + appointment" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="client_id" class="block text-sm font-medium text-gray-700">Cliente</label>
                        <select name="client_id" id="client_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="service_id" class="block text-sm font-medium text-gray-700">Serviço</label>
                        <select name="service_id" id="service_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="date" class="block text-sm font-medium text-gray-700">Data</label>
                        <input type="date" name="date" id="date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="flex justify-end gap-2 mt-6">
                        <button type="button" @click="openEditAppointment = null" class="px-4 py-2 bg-gray-200 rounded">Cancelar</button>
                        <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </template>

    <!-- Modais Serviços -->
    <!-- Modal Criar Serviço -->
    <div x-show="openCreateService" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40" style="display: none;">
        <div class="bg-white rounded-xl shadow-xl p-8 w-full max-w-md relative">
            <button @click="openCreateService = false" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700">&times;</button>
            <h2 class="text-xl font-bold mb-4">Novo Serviço</h2>
            <form action="{{ route('services.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Preço</label>
                    <input type="number" name="price" id="price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required step="0.01">
                </div>
                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" @click="openCreateService = false" class="px-4 py-2 bg-gray-200 rounded">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Editar Serviço -->
    <template x-for="service in {{ Js::from($services->pluck('id')) }}" :key="service">
        <div x-show="openEditService === service" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40" style="display: none;">
            <div class="bg-white rounded-xl shadow-xl p-8 w-full max-w-md relative">
                <button @click="openEditService = null" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700">&times;</button>
                <h2 class="text-xl font-bold mb-4">Editar Serviço</h2>
                <form :action="'{{ url('services') }}/' + service" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                        <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="price" class="block text-sm font-medium text-gray-700">Preço</label>
                        <input type="number" name="price" id="price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required step="0.01">
                    </div>
                    <div class="flex justify-end gap-2 mt-6">
                        <button type="button" @click="openEditService = null" class="px-4 py-2 bg-gray-200 rounded">Cancelar</button>
                        <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </template>

    <!-- Modais Caixa -->
    <!-- Modal Criar Caixa -->
    <div x-show="openCreateCashRegister" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40" style="display: none;">
        <div class="bg-white rounded-xl shadow-xl p-8 w-full max-w-md relative">
            <button @click="openCreateCashRegister = false" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700">&times;</button>
            <h2 class="text-xl font-bold mb-4">Novo Caixa</h2>
            <form action="{{ route('cash_registers.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="amount" class="block text-sm font-medium text-gray-700">Valor</label>
                    <input type="number" name="amount" id="amount" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required step="0.01">
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
                    <input type="text" name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" @click="openCreateCashRegister = false" class="px-4 py-2 bg-gray-200 rounded">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Editar Caixa -->
    <template x-for="cash in {{ Js::from($cash_registers->pluck('id')) }}" :key="cash">
        <div x-show="openEditCashRegister === cash" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40" style="display: none;">
            <div class="bg-white rounded-xl shadow-xl p-8 w-full max-w-md relative">
                <button @click="openEditCashRegister = null" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700">&times;</button>
                <h2 class="text-xl font-bold mb-4">Editar Caixa</h2>
                <form :action="'{{ url('cash_registers') }}/' + cash" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="amount" class="block text-sm font-medium text-gray-700">Valor</label>
                        <input type="number" name="amount" id="amount" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required step="0.01">
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
                        <input type="text" name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="flex justify-end gap-2 mt-6">
                        <button type="button" @click="openEditCashRegister = null" class="px-4 py-2 bg-gray-200 rounded">Cancelar</button>
                        <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </template>
    </div>
</div>
@endsection
