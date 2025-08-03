@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-sm border p-4 md:p-6" x-data="{ openCreate: false, openEdit: null, openDelete: null, form: { name: '', price: '', duration_minutes: '' } }">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <h1 class="text-xl md:text-2xl font-bold text-gray-800 mb-3 sm:mb-0">Serviços</h1>
        <button @click="openCreate = true; form = { name: '', price: '', duration_minutes: '' }"
                class="mobile-btn w-full sm:w-auto px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors shadow-sm font-medium">
            <span class="sm:hidden">+ Novo Serviço</span>
            <span class="hidden sm:inline">Novo Serviço</span>
        </button>
    </div>

    <!-- Mobile view (cards) -->
    <div class="md:hidden space-y-3">
        @foreach($services as $service)
            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                <div class="flex justify-between items-start mb-3">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900 truncate">{{ $service->name }}</h3>
                        <p class="text-lg font-bold text-green-600">R$ {{ number_format($service->price, 2, ',', '.') }}</p>
                        <p class="text-sm text-gray-600">
                            @php
                                $h = floor($service->duration_minutes / 60);
                                $m = $service->duration_minutes % 60;
                                $str = '';
                                if ($h > 0) $str .= $h . 'h ';
                                if ($m > 0) $str .= $m . 'm';
                                if ($str === '') $str = '0m';
                            @endphp
                            Duração: {{ trim($str) }}
                        </p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button @click="openEdit = {{ $service->id }}"
                            class="mobile-btn flex-1 px-3 py-2 bg-yellow-100 text-yellow-800 rounded-md text-sm hover:bg-yellow-200 transition-colors border border-yellow-200 font-medium">
                        Editar
                    </button>
                    <button @click="openDelete = {{ $service->id }}"
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
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Nome</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Preço</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Duração</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($services as $service)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 text-sm text-gray-900">{{ $service->name }}</td>
                            <td class="px-4 py-3 text-sm font-semibold text-green-600">R$ {{ number_format($service->price, 2, ',', '.') }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600">
                                @php
                                    $h = floor($service->duration_minutes / 60);
                                    $m = $service->duration_minutes % 60;
                                    $str = '';
                                    if ($h > 0) $str .= $h . 'h ';
                                    if ($m > 0) $str .= $m . 'm';
                                    if ($str === '') $str = '0m';
                                @endphp
                                {{ trim($str) }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex gap-2">
                                    <button @click="openEdit = {{ $service->id }}"
                                            class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-md text-sm hover:bg-yellow-200 transition-colors border border-yellow-200 font-medium">
                                        Editar
                                    </button>
                                    <button @click="openDelete = {{ $service->id }}"
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

    <x-pagination :paginator="$services" />

    <!-- Modal Criar Serviço -->
    <div x-show="openCreate"
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
         style="display: none;">
        <div class="bg-white rounded-xl shadow-xl mobile-modal w-full max-w-md relative max-h-full overflow-y-auto">
            <div class="sticky top-0 bg-white border-b px-6 py-4 flex items-center justify-between rounded-t-xl">
                <h2 class="text-lg md:text-xl font-bold text-gray-900">Novo Serviço</h2>
                <button @click="openCreate = false" class="mobile-btn p-2 text-gray-400 hover:text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <form action="{{ route('services.store') }}" method="POST" class="p-6">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nome do Serviço *</label>
                        <input type="text"
                               name="name"
                               id="name"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                               required
                               x-model="form.name"
                               placeholder="Ex: Corte de cabelo">
                    </div>
                    <div>
                        <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">Preço *</label>
                        <input type="number"
                               name="price"
                               id="price"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                               step="0.01"
                               required
                               x-model="form.price"
                               placeholder="0,00">
                    </div>
                    <div>
                        <label for="duration_minutes" class="block text-sm font-semibold text-gray-700 mb-2">Duração (minutos) *</label>
                        <input type="number"
                               name="duration_minutes"
                               id="duration_minutes"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                               required
                               x-model="form.duration_minutes"
                               placeholder="Ex: 30">
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 mt-8">
                    <button type="button"
                            @click="openCreate = false; form = { name: '', price: '', duration_minutes: '' }"
                            class="mobile-btn order-2 sm:order-1 px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 border border-gray-300 transition-colors font-medium">
                        Cancelar
                    </button>
                    <button type="submit"
                            class="mobile-btn order-1 sm:order-2 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium shadow-sm">
                        Salvar Serviço
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modais de Edição -->
    @foreach($services as $service)
        <div x-show="openEdit === {{ $service->id }}"
             x-transition:enter="transition ease-out duration-100"
             x-transition:enter-start="transform opacity-0 scale-95"
             x-transition:enter-end="transform opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-75"
             x-transition:leave-start="transform opacity-100 scale-100"
             x-transition:leave-end="transform opacity-0 scale-95"
             class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
             style="display: none;">
            <div class="bg-white rounded-xl shadow-xl mobile-modal w-full max-w-md relative max-h-full overflow-y-auto">
                <div class="sticky top-0 bg-white border-b px-6 py-4 flex items-center justify-between rounded-t-xl">
                    <h2 class="text-lg md:text-xl font-bold text-gray-900">Editar Serviço</h2>
                    <button @click="openEdit = null" class="mobile-btn p-2 text-gray-400 hover:text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <form action="{{ route('services.update', $service->id) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div>
                            <label for="edit_name_{{ $service->id }}" class="block text-sm font-semibold text-gray-700 mb-2">Nome do Serviço *</label>
                            <input type="text"
                                   name="name"
                                   id="edit_name_{{ $service->id }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                   required
                                   value="{{ $service->name }}">
                        </div>
                        <div>
                            <label for="edit_price_{{ $service->id }}" class="block text-sm font-semibold text-gray-700 mb-2">Preço *</label>
                            <input type="number"
                                   name="price"
                                   id="edit_price_{{ $service->id }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                   step="0.01"
                                   required
                                   value="{{ $service->price }}">
                        </div>
                        <div>
                            <label for="edit_duration_minutes_{{ $service->id }}" class="block text-sm font-semibold text-gray-700 mb-2">Duração (minutos) *</label>
                            <input type="number"
                                   name="duration_minutes"
                                   id="edit_duration_minutes_{{ $service->id }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                   required
                                   value="{{ $service->duration_minutes }}">
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3 mt-8">
                        <button type="button"
                                @click="openEdit = null"
                                class="mobile-btn order-2 sm:order-1 px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 border border-gray-300 transition-colors font-medium">
                            Cancelar
                        </button>
                        <button type="submit"
                                class="mobile-btn order-1 sm:order-2 px-6 py-3 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors font-medium shadow-sm">
                            Atualizar Serviço
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    <!-- Modais de Exclusão -->
    @foreach($services as $service)
        <div x-show="openDelete === {{ $service->id }}"
             x-transition:enter="transition ease-out duration-100"
             x-transition:enter-start="transform opacity-0 scale-95"
             x-transition:enter-end="transform opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-75"
             x-transition:leave-start="transform opacity-100 scale-100"
             x-transition:leave-end="transform opacity-0 scale-95"
             class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
             style="display: none;">
            <div class="bg-white rounded-xl shadow-xl mobile-modal w-full max-w-md relative">
                <div class="p-6">
                    <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 bg-red-100 rounded-full">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.08 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <h2 class="text-lg md:text-xl font-bold mb-4 text-red-600 text-center">Excluir Serviço</h2>
                    <p class="mb-6 text-gray-600 text-center">
                        Tem certeza que deseja excluir o serviço <strong class="text-gray-900">{{ $service->name }}</strong>?
                        <br><span class="text-sm text-red-500">Esta ação não pode ser desfeita.</span>
                    </p>
                    <form action="{{ route('services.destroy', $service->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="flex flex-col sm:flex-row gap-3">
                            <button type="button"
                                    @click="openDelete = null"
                                    class="mobile-btn order-2 sm:order-1 px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 border border-gray-300 transition-colors font-medium">
                                Cancelar
                            </button>
                            <button type="submit"
                                    class="mobile-btn order-1 sm:order-2 px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium shadow-sm">
                                Sim, Excluir
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
