<!-- Modal Create Client -->
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
            <h2 class="text-lg md:text-xl font-bold text-gray-900">Novo Cliente</h2>
            <button @click="openCreate = false" class="mobile-btn p-2 text-gray-400 hover:text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <form action="{{ route('clients.store') }}" method="POST" class="p-6">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nome *</label>
                    <input type="text"
                           name="name"
                           id="name"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           required
                           placeholder="Digite o nome completo">
                </div>
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <input type="email"
                           name="email"
                           id="email"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="exemplo@email.com">
                </div>
                <div>
                    <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Telefone</label>
                    <input type="tel"
                           name="phone"
                           id="phone"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="(11) 99999-9999">
                </div>
            </div>
            <div class="flex flex-col sm:flex-row gap-3 mt-8">
                <button type="button"
                        @click="openCreate = false"
                        class="mobile-btn order-2 sm:order-1 px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 border border-gray-300 transition-colors font-medium">
                    Cancelar
                </button>
                <button type="submit"
                        class="mobile-btn order-1 sm:order-2 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium shadow-sm">
                    Salvar Cliente
                </button>
            </div>
        </form>
    </div>
</div>
