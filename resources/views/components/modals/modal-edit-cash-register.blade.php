<!-- Modal Editar Caixa -->
<div x-data x-show="$store.cashRegister.openEditCashRegister !== null" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40" style="display: none;">
    <div class="bg-white rounded-xl shadow-xl p-8 w-full max-w-md relative">
        <button @click="$store.cashRegister.openEditCashRegister = null" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700">&times;</button>
        <h2 class="text-xl font-bold mb-4">Editar Caixa</h2>
        <form :action="'{{ url('cash_registers') }}/' + $store.cashRegister.openEditCashRegister" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="service_id" class="block text-sm font-medium text-gray-700">Serviço</label>
                <select name="service_id" id="service_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required x-model="$store.cashRegister.form.service_id">
                    <option value="">Selecione</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="client_id" class="block text-sm font-medium text-gray-700">Cliente</label>
                <select name="client_id" id="client_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required x-model="$store.cashRegister.form.client_id">
                    <option value="">Selecione</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="amount" class="block text-sm font-medium text-gray-700">Valor</label>
                <input type="number" name="amount" id="amount" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required step="0.01" x-model="$store.cashRegister.form.amount">
            </div>
            <div class="mb-4">
                <label for="payment_type" class="block text-sm font-medium text-gray-700">Tipo de Pagamento</label>
                <select name="payment_type" id="payment_type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required x-model="$store.cashRegister.form.payment_type">
                    <option value="">Selecione</option>
                    <option value="dinheiro">Dinheiro</option>
                    <option value="pix">Pix</option>
                    <option value="cartao">Cartão</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required x-model="$store.cashRegister.form.status">
                    <option value="em_aberto">Em aberto</option>
                    <option value="pago">Pago</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="payment_date" class="block text-sm font-medium text-gray-700">Data do Pagamento</label>
                <input type="date" name="payment_date" id="payment_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required x-model="$store.cashRegister.form.payment_date">
            </div>
            <div class="flex justify-end gap-2 mt-6">
                <button type="button" @click="$store.cashRegister.openEditCashRegister = null" class="px-4 py-2 bg-gray-200 rounded">Cancelar</button>
                <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Salvar</button>
            </div>
        </form>
    </div>
</div>
