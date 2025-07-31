
@php use Carbon\Carbon; @endphp
@extends('layouts.app')

@section('content')
<div class="bg-white rounded shadow p-6" x-data="{ openCreate: false, openEdit: null, openDelete: null, form: { service_id: '', client_id: '', amount: '', payment_type: '', status: 'em aberto', payment_date: '' } }">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Caixa - Controle Financeiro</h1>
    <div class="flex flex-wrap items-center gap-4 mb-6">
        <button @click="openCreate = true; form = { service_id: '', client_id: '', amount: '', payment_type: '', status: 'em aberto', payment_date: '' }" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Novo Caixa</button>
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
                    <tr class="border-b">
                        <td class="px-3 py-2">{{ $register->id }}</td>
                        <td class="px-3 py-2">{{ $register->service->name ?? '-' }}</td>
                        <td class="px-3 py-2">{{ $register->client->name ?? '-' }}</td>
                        <td class="px-3 py-2">R$ {{ number_format($register->amount, 2, ',', '.') }}</td>
                        <td class="px-3 py-2">
                            <span class="px-2 py-1 rounded bg-blue-200 text-blue-800 text-xs">{{ $register->payment_type }}</span>
                        </td>
                        <td class="px-3 py-2">
                            <span class="px-2 py-1 rounded text-xs {{ $register->status == 'pago' ? 'bg-green-500 text-white' : 'bg-yellow-400 text-gray-800' }}">
                                {{ $register->status == 'pago' ? 'Pago' : 'Em aberto' }}
                            </span>
                        </td>
                        <td class="px-3 py-2">{{ Carbon::parse($register->payment_date)->format('d/m/Y') }}</td>
                        <td class="px-3 py-2 flex gap-2">
                            <button @click="openEdit = {{ $register->id }}" class="px-2 py-1 bg-yellow-400 text-gray-900 rounded text-xs hover:bg-yellow-500 transition">Editar</button>
                            <button @click="openDelete = {{ $register->id }}" class="px-2 py-1 bg-red-500 text-white rounded text-xs hover:bg-red-600 transition">Excluir</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <x-pagination :paginator="$cashRegisters" />
    <!-- Modal Criar Caixa -->
    <div x-show="openCreate" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40" style="display: none;">
        <div class="bg-white rounded-xl shadow-xl p-8 w-full max-w-md relative">
            <button @click="openCreate = false" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700">&times;</button>
            <h2 class="text-xl font-bold mb-4">Novo Caixa</h2>
            <form action="{{ route('cash_registers.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="service_id" class="block text-sm font-medium text-gray-700">Serviço</label>
                    <select name="service_id" id="service_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required x-model="form.service_id">
                        <option value="">Selecione</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="client_id" class="block text-sm font-medium text-gray-700">Cliente</label>
                    <select name="client_id" id="client_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required x-model="form.client_id">
                        <option value="">Selecione</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="amount" class="block text-sm font-medium text-gray-700">Valor</label>
                    <input type="number" name="amount" id="amount" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" step="0.01" required x-model="form.amount">
                </div>
                <div class="mb-4">
                    <label for="payment_type" class="block text-sm font-medium text-gray-700">Tipo de Pagamento</label>
                    <select name="payment_type" id="payment_type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required x-model="form.payment_type">
                        <option value="">Selecione</option>
                        <option value="dinheiro">Dinheiro</option>
                        <option value="cartao">Cartão</option>
                        <option value="pix">Pix</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required x-model="form.status">
                        <option value="em aberto">Em aberto</option>
                        <option value="pago">Pago</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="payment_date" class="block text-sm font-medium text-gray-700">Data do Pagamento</label>
                    <input type="date" name="payment_date" id="payment_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required x-model="form.payment_date">
                </div>
                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" @click="openCreate = false; form = { service_id: '', client_id: '', amount: '', payment_type: '', status: 'em aberto', payment_date: '' }" class="px-4 py-2 bg-gray-200 rounded">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Editar Caixa -->
    @foreach($cashRegisters as $register)
        <div x-show="openEdit === {{ $register->id }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40" style="display: none;">
            <div class="bg-white rounded-xl shadow-xl p-8 w-full max-w-md relative">
                <button @click="openEdit = null" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700">&times;</button>
                <h2 class="text-xl font-bold mb-4">Editar Caixa</h2>
                <form action="{{ route('cash_registers.update', $register->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="edit_service_id_{{ $register->id }}" class="block text-sm font-medium text-gray-700">Serviço</label>
                        <select name="service_id" id="edit_service_id_{{ $register->id }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="">Selecione</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}" {{ $register->service_id == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="edit_client_id_{{ $register->id }}" class="block text-sm font-medium text-gray-700">Cliente</label>
                        <select name="client_id" id="edit_client_id_{{ $register->id }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="">Selecione</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ $register->client_id == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="edit_amount_{{ $register->id }}" class="block text-sm font-medium text-gray-700">Valor</label>
                        <input type="number" name="amount" id="edit_amount_{{ $register->id }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" step="0.01" required value="{{ $register->amount }}">
                    </div>
                    <div class="mb-4">
                        <label for="edit_payment_type_{{ $register->id }}" class="block text-sm font-medium text-gray-700">Tipo de Pagamento</label>
                        <select name="payment_type" id="edit_payment_type_{{ $register->id }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="">Selecione</option>
                            <option value="dinheiro" {{ $register->payment_type == 'dinheiro' ? 'selected' : '' }}>Dinheiro</option>
                            <option value="cartao" {{ $register->payment_type == 'cartao' ? 'selected' : '' }}>Cartão</option>
                            <option value="pix" {{ $register->payment_type == 'pix' ? 'selected' : '' }}>Pix</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="edit_status_{{ $register->id }}" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="edit_status_{{ $register->id }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="em aberto" {{ $register->status == 'em aberto' ? 'selected' : '' }}>Em aberto</option>
                            <option value="pago" {{ $register->status == 'pago' ? 'selected' : '' }}>Pago</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="edit_payment_date_{{ $register->id }}" class="block text-sm font-medium text-gray-700">Data do Pagamento</label>
                        <input type="date" name="payment_date" id="edit_payment_date_{{ $register->id }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required value="{{ $register->payment_date }}">
                    </div>
                    <div class="flex justify-end gap-2 mt-6">
                        <button type="button" @click="openEdit = null" class="px-4 py-2 bg-gray-200 rounded">Cancelar</button>
                        <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    <!-- Modal Excluir Caixa -->
    @foreach($cashRegisters as $register)
        <div x-show="openDelete === {{ $register->id }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40" style="display: none;">
            <div class="bg-white rounded-xl shadow-xl p-8 w-full max-w-md relative">
                <button @click="openDelete = null" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700">&times;</button>
                <h2 class="text-xl font-bold mb-4 text-red-600">Excluir Caixa</h2>
                <p class="mb-6">Tem certeza que deseja excluir o registro de caixa <strong>ID {{ $register->id }}</strong>?</p>
                <form action="{{ route('cash_registers.destroy', $register->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex justify-end gap-2 mt-6">
                        <button type="button" @click="openDelete = null" class="px-4 py-2 bg-gray-200 rounded">Cancelar</button>
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Excluir</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
