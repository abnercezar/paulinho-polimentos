@extends('layouts.app')

@section('content')
<div x-data="{ openCreate: false, openEdit: null, openDelete: null, openCreateAppointment: false, openEditAppointment: null, openCreateService: false, openEditService: null, openCreateCashRegister: false, openEditCashRegister: null }">
    <div class="bg-white rounded shadow p-6">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Clientes</h1>
        <button @click="openCreate = true" class="px-4 py-2 bg-blue-100 text-blue-800 rounded hover:bg-blue-200 transition mb-4 inline-block border border-blue-200">Novo Cliente</button>
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
                        <tr class="border-b {{ $loop->odd ? 'bg-gray-100' : 'bg-white' }}">
                            <td class="px-3 py-2">{{ $client->name }}</td>
                            <td class="px-3 py-2">{{ $client->email }}</td>
                            <td class="px-3 py-2">{{ $client->phone }}</td>
                            <td class="px-3 py-2 flex gap-2">
                                <button @click="openEdit = {{ $client->id }}" class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs hover:bg-yellow-200 transition border border-yellow-200">Editar</button>
                                <button @click="openDelete = {{ $client->id }}" class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs hover:bg-red-200 transition border border-red-200">Excluir</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <x-pagination :paginator="$clients" />
    <!-- Modais CRUD -->
    <x-modals.modal-create-client />
    <x-modals.modal-edit-client :clients="$clients" />
    <x-modals.modal-delete-client :clients="$clients" />
    </div>
</div>
@endsection
