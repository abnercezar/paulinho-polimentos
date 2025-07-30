@extends('layouts.app')

@section('content')
<div class="bg-white rounded shadow p-6 max-w-xl mx-auto">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Novo Registro de Caixa</h1>
    <form action="{{ route('cash_registers.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="service_id" class="block text-sm font-medium text-gray-700 mb-1">Serviço</label>
            <select name="service_id" id="service_id" class="w-full border rounded px-3 py-2" required>
                <option value="">Selecione...</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="client_id" class="block text-sm font-medium text-gray-700 mb-1">Cliente</label>
            <select name="client_id" id="client_id" class="w-full border rounded px-3 py-2" required>
                <option value="">Selecione...</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Valor</label>
            <input type="number" step="0.01" name="amount" id="amount" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label for="payment_type" class="block text-sm font-medium text-gray-700 mb-1">Tipo de Pagamento</label>
            <select name="payment_type" id="payment_type" class="w-full border rounded px-3 py-2" required>
                <option value="dinheiro">Dinheiro</option>
                <option value="cartao">Cartão</option>
                <option value="pix">Pix</option>
                <option value="pagar_em">Pagar em</option>
            </select>
        </div>
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" id="status" class="w-full border rounded px-3 py-2" required>
                <option value="pago">Pago</option>
                <option value="em_aberto">Em aberto</option>
            </select>
        </div>
        <div>
            <label for="payment_date" class="block text-sm font-medium text-gray-700 mb-1">Data do Pagamento</label>
            <input type="date" name="payment_date" id="payment_date" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="flex gap-2 mt-4">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">Salvar</button>
            <a href="{{ route('cash_registers.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">Voltar</a>
        </div>
    </form>
</div>
@endsection
