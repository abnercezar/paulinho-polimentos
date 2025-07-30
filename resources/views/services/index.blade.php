@extends('layouts.app')

@section('content')
<div class="bg-white rounded shadow p-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Serviços</h1>
    <a href="{{ route('services.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition mb-4 inline-block">Novo Serviço</a>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-700">Nome</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-700">Preço</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-700">Duração (min)</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-700">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                    <tr class="border-b">
                        <td class="px-3 py-2">{{ $service->name }}</td>
                        <td class="px-3 py-2">R$ {{ number_format($service->price, 2, ',', '.') }}</td>
                        <td class="px-3 py-2">{{ $service->duration_minutes }}</td>
                        <td class="px-3 py-2 flex gap-2">
                            <a href="{{ route('services.edit', $service) }}" class="px-2 py-1 bg-yellow-400 text-gray-900 rounded text-xs hover:bg-yellow-500 transition">Editar</a>
                            <form action="{{ route('services.destroy', $service) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este serviço?')">
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
    <x-pagination :paginator="$services" />
</div>
@endsection
