@extends('layouts.app')

@section('content')
<div class="bg-white rounded shadow p-6" x-data="{ openCreate: false, openEdit: null, openDelete: null, form: { name: '', price: '', duration_minutes: '' } }">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Serviços</h1>
    <button @click="openCreate = true; form = { name: '', price: '', duration_minutes: '' }" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition mb-4 inline-block">Novo Serviço</button>
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
                            <button @click="openEdit = {{ $service->id }}" class="px-2 py-1 bg-yellow-400 text-gray-900 rounded text-xs hover:bg-yellow-500 transition">Editar</button>
                            <button @click="openDelete = {{ $service->id }}" class="px-2 py-1 bg-red-500 text-white rounded text-xs hover:bg-red-600 transition">Excluir</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <x-pagination :paginator="$services" />
    <!-- Modal Criar Serviço -->
    <div x-show="openCreate" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40" style="display: none;">
        <div class="bg-white rounded-xl shadow-xl p-8 w-full max-w-md relative">
            <button @click="openCreate = false" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700">&times;</button>
            <h2 class="text-xl font-bold mb-4">Novo Serviço</h2>
            <form action="{{ route('services.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required x-model="form.name">
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Preço</label>
                    <input type="number" name="price" id="price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" step="0.01" required x-model="form.price">
                </div>
                <div class="mb-4">
                    <label for="duration_minutes" class="block text-sm font-medium text-gray-700">Duração (minutos)</label>
                    <input type="number" name="duration_minutes" id="duration_minutes" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required x-model="form.duration_minutes">
                </div>
                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" @click="openCreate = false; form = { name: '', price: '', duration_minutes: '' }" class="px-4 py-2 bg-gray-200 rounded">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    @foreach($services as $service)
        <div x-show="openEdit === {{ $service->id }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40" style="display: none;">
            <div class="bg-white rounded-xl shadow-xl p-8 w-full max-w-md relative">
                <button @click="openEdit = null" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700">&times;</button>
                <h2 class="text-xl font-bold mb-4">Editar Serviço</h2>
                <form action="{{ route('services.update', $service->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="edit_name_{{ $service->id }}" class="block text-sm font-medium text-gray-700">Nome</label>
                        <input type="text" name="name" id="edit_name_{{ $service->id }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required value="{{ $service->name }}">
                    </div>
                    <div class="mb-4">
                        <label for="edit_price_{{ $service->id }}" class="block text-sm font-medium text-gray-700">Preço</label>
                        <input type="number" name="price" id="edit_price_{{ $service->id }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" step="0.01" required value="{{ $service->price }}">
                    </div>
                    <div class="mb-4">
                        <label for="edit_duration_minutes_{{ $service->id }}" class="block text-sm font-medium text-gray-700">Duração (minutos)</label>
                        <input type="number" name="duration_minutes" id="edit_duration_minutes_{{ $service->id }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required value="{{ $service->duration_minutes }}">
                    </div>
                    <div class="flex justify-end gap-2 mt-6">
                        <button type="button" @click="openEdit = null" class="px-4 py-2 bg-gray-200 rounded">Cancelar</button>
                        <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    @foreach($services as $service)
        <div x-show="openDelete === {{ $service->id }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40" style="display: none;">
            <div class="bg-white rounded-xl shadow-xl p-8 w-full max-w-md relative">
                <button @click="openDelete = null" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700">&times;</button>
                <h2 class="text-xl font-bold mb-4 text-red-600">Excluir Serviço</h2>
                <p class="mb-6">Tem certeza que deseja excluir o serviço <strong>{{ $service->name }}</strong>?</p>
                <form action="{{ route('services.destroy', $service->id) }}" method="POST">
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
</div>
@endsection
