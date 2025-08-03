@php use Carbon\Carbon; @endphp

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('cashRegister', {
            openCreateCashRegister: false,
            openEditCashRegister: null,
            openDeleteCashRegister: null,
            form: { service_id: '', client_id: '', amount: '', payment_type: '', status: 'em_aberto', payment_date: '' }
        });
    });
</script>
@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-sm border p-4 md:p-6" x-data="{ openCreateCashRegister: false, openEditCashRegister: null, openDeleteCashRegister: null, form: { service_id: '', client_id: '', amount: '', payment_type: '', status: 'em_aberto', payment_date: '' } }">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <h1 class="text-lg md:text-2xl font-bold text-gray-800 mb-3 sm:mb-0">Caixa</h1>
        <button @click="openCreateCashRegister = true; form = { service_id: '', client_id: '', amount: '', payment_type: '', status: 'em_aberto', payment_date: '' }"
                class="mobile-btn w-full sm:w-auto px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors shadow-sm font-medium">
            <span class="sm:hidden">+ Nova Entrada</span>
            <span class="hidden sm:inline">Nova Entrada</span>
        </button>
    </div>

    <!-- Resumo financeiro -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
            <div class="text-sm text-green-600 font-medium">Hoje</div>
            <div class="text-lg md:text-xl font-bold text-green-700">R$ {{ number_format($sumDay, 2, ',', '.') }}</div>
        </div>
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="text-sm text-blue-600 font-medium">Este Mês</div>
            <div class="text-lg md:text-xl font-bold text-blue-700">R$ {{ number_format($sumMonth, 2, ',', '.') }}</div>
        </div>
        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="text-sm text-red-600 font-medium">A Receber</div>
            <div class="text-lg md:text-xl font-bold text-red-700">R$ {{ number_format($sumReceber, 2, ',', '.') }}</div>
        </div>
        <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
            <div class="text-sm text-purple-600 font-medium">Total</div>
            <div class="text-lg md:text-xl font-bold text-purple-700">R$ {{ number_format($sumMonth + $sumReceber, 2, ',', '.') }}</div>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 px-4 py-3 bg-green-100 border border-green-200 text-green-800 rounded-lg">{{ session('success') }}</div>
    @endif

    <!-- Mobile view (cards) -->
    <div class="md:hidden space-y-3">
        @foreach($cashRegisters as $register)
            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                <div class="flex justify-between items-start mb-3">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900 truncate">{{ $register->service->name ?? 'Serviço não informado' }}</h3>
                        <p class="text-sm text-gray-600 truncate">{{ $register->client->name ?? 'Cliente não informado' }}</p>
                        <p class="text-lg font-bold text-green-600">R$ {{ number_format($register->amount, 2, ',', '.') }}</p>
                        <p class="text-sm text-gray-600">{{ Carbon::parse($register->payment_date)->format('d/m/Y') }}</p>
                    </div>
                    <div class="ml-3 text-right">
                        @php
                            $statusColors = [
                                'em_aberto' => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                                'pago' => 'bg-green-100 text-green-800 border border-green-200',
                            ];
                        @endphp
                        <span class="px-2 py-1 rounded-full text-xs font-medium {{ $statusColors[$register->status] ?? 'bg-gray-300 text-gray-800' }}">
                            {{ $register->status == 'pago' ? 'Pago' : ($register->status == 'em_aberto' ? 'Em aberto' : $register->status) }}
                        </span>
                        <div class="mt-1 text-xs text-gray-500">{{ $register->payment_type }}</div>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button @click="
                        $store.cashRegister.openEditCashRegister = Number({{ $register->id }});
                        $store.cashRegister.form = {
                            service_id: '{{ $register->service_id }}',
                            client_id: '{{ $register->client_id }}',
                            amount: '{{ $register->amount }}',
                            payment_type: '{{ $register->payment_type }}',
                            status: '{{ trim($register->status) }}',
                            payment_date: '{{ $register->payment_date }}'
                        };
                    " class="mobile-btn flex-1 px-3 py-2 bg-yellow-100 text-yellow-800 rounded-md text-sm hover:bg-yellow-200 transition-colors border border-yellow-200 font-medium">
                        Editar
                    </button>
                    <button @click="openDeleteCashRegister = {{ $register->id }}"
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
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">ID</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Serviço</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Cliente</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Valor</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Pagamento</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Data</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($cashRegisters as $register)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 text-sm text-gray-900">{{ $register->id }}</td>
                            <td class="px-4 py-3 text-sm text-gray-900">{{ $register->service->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600">{{ $register->client->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm font-semibold text-green-600">R$ {{ number_format($register->amount, 2, ',', '.') }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded-full bg-blue-100 text-blue-800 text-xs font-medium">{{ $register->payment_type }}</span>
                            </td>
                            <td class="px-4 py-3">
                                @php
                                    $statusColors = [
                                        'em_aberto' => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                                        'pago' => 'bg-green-100 text-green-800 border border-green-200',
                                    ];
                                @endphp
                                <span class="px-2 py-1 rounded-full text-xs font-medium {{ $statusColors[$register->status] ?? 'bg-gray-300 text-gray-800' }}">
                                    {{ $register->status == 'pago' ? 'Pago' : ($register->status == 'em_aberto' ? 'Em aberto' : $register->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-600">{{ Carbon::parse($register->payment_date)->format('d/m/Y') }}</td>
                            <td class="px-4 py-3">
                                <div class="flex gap-2">
                                    <button @click="
                                        $store.cashRegister.openEditCashRegister = Number({{ $register->id }});
                                        $store.cashRegister.form = {
                                            service_id: '{{ $register->service_id }}',
                                            client_id: '{{ $register->client_id }}',
                                            amount: '{{ $register->amount }}',
                                            payment_type: '{{ $register->payment_type }}',
                                            status: '{{ trim($register->status) }}',
                                            payment_date: '{{ $register->payment_date }}'
                                        };
                                    " class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-md text-sm hover:bg-yellow-200 transition-colors border border-yellow-200 font-medium">
                                        Editar
                                    </button>
                                    <button @click="openDeleteCashRegister = {{ $register->id }}"
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

    <x-pagination :paginator="$cashRegisters" />
    <x-modals.modal-create-cash-register :services="$services" :clients="$clients" />
    <x-modals.modal-edit-cash-register :cash_registers="$cashRegisters" :services="$services" :clients="$clients" />
    <x-modals.modal-delete-cash-register :cash_registers="$cashRegisters" />
</div>
@endsection
