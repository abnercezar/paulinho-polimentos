<!-- Modal Delete Cash Register -->
<template x-for="cash in {{ Js::from($cashRegisters->pluck('id')) }}" :key="cash">
    <div x-show="openDeleteCashRegister === cash" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40" style="display: none;">
        <div class="bg-white rounded-xl shadow-xl p-8 w-full max-w-md relative">
            <button @click="openDeleteCashRegister = null" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700">&times;</button>
            <h2 class="text-xl font-bold mb-4 text-red-600">Excluir Caixa</h2>
            <p class="mb-6">Tem certeza que deseja excluir este caixa?</p>
            <form :action="'{{ url('cash_registers') }}/' + cash" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" @click="openDeleteCashRegister = null" class="px-4 py-2 bg-gray-100 text-gray-800 rounded hover:bg-gray-200 border border-gray-200">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-red-100 text-red-800 rounded hover:bg-red-200 border border-red-200">Excluir</button>
                </div>
            </form>
        </div>
    </div>
</template>
