@extends('layouts.app')

@section('content')
<div x-data="{ openCreate: false, openEdit: null, openDelete: null, openCreateAppointment: false, openEditAppointment: null, openCreateService: false, openEditService: null, openCreateCashRegister: false, openEditCashRegister: null }">
    <div class="bg-white rounded-lg shadow-sm border p-4 md:p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
            <h1 class="text-xl md:text-2xl font-bold text-gray-800 mb-3 sm:mb-0">Clientes</h1>
            <button @click="openCreate = true" class="mobile-btn w-full sm:w-auto px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors shadow-sm font-medium">
                <span class="sm:hidden">+ Novo Cliente</span>
                <span class="hidden sm:inline">Novo Cliente</span>
            </button>
        </div>

        <!-- Mobile view (cards) -->
        <div class="md:hidden space-y-3">
            @foreach ($clients as $client)
                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-gray-900 truncate">{{ $client->name }}</h3>
                            <p class="text-sm text-gray-600 truncate">{{ $client->email }}</p>
                            <p class="text-sm text-gray-600">{{ $client->phone }}</p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button @click="openEdit = {{ $client->id }}" class="mobile-btn flex-1 px-3 py-2 bg-yellow-100 text-yellow-800 rounded-md text-sm hover:bg-yellow-200 transition-colors border border-yellow-200 font-medium">
                            Editar
                        </button>
                        <button @click="openDelete = {{ $client->id }}" class="mobile-btn flex-1 px-3 py-2 bg-red-100 text-red-800 rounded-md text-sm hover:bg-red-200 transition-colors border border-red-200 font-medium">
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
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Nome</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">E-mail</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Telefone</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($clients as $client)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3 text-sm text-gray-900">{{ $client->name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $client->email }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $client->phone }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex gap-2">
                                        <button @click="openEdit = {{ $client->id }}" class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-md text-sm hover:bg-yellow-200 transition-colors border border-yellow-200 font-medium">
                                            Editar
                                        </button>
                                        <button @click="openDelete = {{ $client->id }}" class="px-3 py-1 bg-red-100 text-red-800 rounded-md text-sm hover:bg-red-200 transition-colors border border-red-200 font-medium">
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

        <x-pagination :paginator="$clients" />

    <!-- Modais CRUD -->
    <x-modals.modal-create-client />
    <x-modals.modal-edit-client :clients="$clients" />
    <x-modals.modal-delete-client :clients="$clients" />
    </div>
</div>
@endsection
