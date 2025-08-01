<!-- Modal Criar Agendamento -->
@props(['clients', 'services'])
<div x-show="openCreate" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40" style="display: none;">
    <div class="bg-white rounded-xl shadow-xl p-8 w-full max-w-md relative">
        <button @click="openCreate = false" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700">&times;</button>
        <h2 class="text-xl font-bold mb-4">Novo Agendamento</h2>
        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="client_id" class="block text-sm font-medium text-gray-700">Cliente</label>
                <select name="client_id" id="client_id" x-ref="client_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required x-model="createForm.client_id">
                    <option value="">Selecione</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="service_id" class="block text-sm font-medium text-gray-700">Serviço</label>
                <select name="service_id" id="service_id" x-ref="service_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required x-model="createForm.service_id">
                    <option value="">Selecione</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="scheduled_at" class="block text-sm font-medium text-gray-700">Data e Hora</label>
                <input type="datetime-local" name="scheduled_at" id="scheduled_at" x-ref="scheduled_at" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required x-model="createForm.scheduled_at">
            </div>
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" x-ref="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required x-model="createForm.status">
                    <option value="pendente">Pendente</option>
                    <option value="confirmado">Confirmado</option>
                    <option value="cancelado">Cancelado</option>
                    <option value="concluido">Concluído</option>
                </select>
            </div>
            <div class="flex justify-end gap-2 mt-6">
                <button type="button" @click="openCreate = false" class="px-4 py-2 bg-gray-100 text-gray-800 rounded hover:bg-gray-200 border border-gray-200">Cancelar</button>
                <button type="submit" class="px-4 py-2 bg-blue-100 text-blue-800 rounded hover:bg-blue-200 border border-blue-200">Salvar</button>
            </div>
        </form>
    </div>
</div>
