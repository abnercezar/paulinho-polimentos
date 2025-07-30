
@php use Carbon\Carbon; @endphp
@extends('layouts.app')

@section('content')
<div class="bg-white rounded shadow p-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Caixa - Controle Financeiro</h1>
    <div class="flex flex-wrap items-center gap-4 mb-6">
        <a href="{{ route('cash_registers.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Novo Registro</a>
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
                            <a href="{{ route('cash_registers.edit', $register) }}" class="px-2 py-1 bg-yellow-400 text-gray-900 rounded text-xs hover:bg-yellow-500 transition">Editar</a>
                            <form action="{{ route('cash_registers.destroy', $register) }}" method="POST" onsubmit="return confirm('Tem certeza?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded text-xs hover:bg-red-600 transition">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <x-pagination :paginator="$cashRegisters" />
</div>
@endsection
