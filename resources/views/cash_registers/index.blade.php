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
<div class="bg-white rounded shadow p-6" x-data="{ openCreateCashRegister: false, openEditCashRegister: null, openDeleteCashRegister: null, form: { service_id: '', client_id: '', amount: '', payment_type: '', status: 'em_aberto', payment_date: '' } }">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Caixa - Controle Financeiro</h1>
    <div class="flex flex-wrap items-center gap-4 mb-6">
        <button @click="openCreateCashRegister = true; form = { service_id: '', client_id: '', amount: '', payment_type: '', status: 'em_aberto', payment_date: '' }" class="px-4 py-2 bg-blue-100 text-blue-800 rounded hover:bg-blue-200 transition border border-blue-200">Novo Caixa</button>
        <div class="font-semibold">Dia: <span class="px-2 py-1 rounded bg-green-500 text-white">R$ {{ number_format($sumDay, 2, ',', '.') }}</span></div>
        <div class="font-semibold">Mês: <span class="px-2 py-1 rounded bg-blue-500 text-white">R$ {{ number_format($sumMonth, 2, ',', '.') }}</span></div>
        <div class="font-semibold">A receber: <span class="px-2 py-1 rounded bg-red-500 text-white">R$ {{ number_format($sumReceber, 2, ',', '.') }}</span></div>
    </div>
    @if(session('success'))
        <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-700">ID</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-700">Serviço</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-700">Cliente</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-700">Valor</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-700">Tipo de Pagamento</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-700">Status</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-700">Data do Pagamento</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-700">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cashRegisters as $register)
                    <tr class="border-b {{ $loop->odd ? 'bg-gray-100' : 'bg-white' }}">
                        <td class="px-3 py-2">{{ $register->id }}</td>
                        <td class="px-3 py-2">{{ $register->service->name ?? '-' }}</td>
                        <td class="px-3 py-2">{{ $register->client->name ?? '-' }}</td>
                        <td class="px-3 py-2">R$ {{ number_format($register->amount, 2, ',', '.') }}</td>
                        <td class="px-3 py-2">
                            <span class="px-2 py-1 rounded bg-blue-200 text-blue-800 text-xs">{{ $register->payment_type }}</span>
                        </td>
                        <td class="px-3 py-2">
                            @php
                                $statusColors = [
                                    'em_aberto' => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                                    'pago' => 'bg-green-100 text-green-800 border border-green-200',
                                ];
                            @endphp
                            <span class="px-2 py-1 rounded text-xs {{ $statusColors[$register->status] ?? 'bg-gray-300 text-gray-800' }}">
                                {{ $register->status == 'pago' ? 'Pago' : ($register->status == 'em_aberto' ? 'Em aberto' : $register->status) }}
                            </span>
                        </td>
                        <td class="px-3 py-2">{{ Carbon::parse($register->payment_date)->format('d/m/Y') }}</td>
                        <td class="px-3 py-2 flex gap-2">
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
                            " class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs hover:bg-yellow-200 transition border border-yellow-200">Editar</button>
                            <button @click="openDeleteCashRegister = {{ $register->id }}" class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs hover:bg-red-200 transition border border-red-200">Excluir</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <x-pagination :paginator="$cashRegisters" />
    <x-modals.modal-create-cash-register :services="$services" :clients="$clients" />
    <x-modals.modal-edit-cash-register :cash_registers="$cashRegisters" :services="$services" :clients="$clients" />
    <x-modals.modal-delete-cash-register :cash_registers="$cashRegisters" />
</div>
@endsection
