@extends('layouts.app')

@section('content')
<div class="bg-white rounded shadow p-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Clientes</h1>
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
                            <a href="{{ route('clients.edit', $client) }}" class="px-2 py-1 bg-yellow-400 text-gray-900 rounded text-xs hover:bg-yellow-500 transition">Editar</a>
                            <form action="{{ route('clients.destroy', $client) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este cliente?')">
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
    <x-pagination :paginator="$clients" />
</div>
@endsection
