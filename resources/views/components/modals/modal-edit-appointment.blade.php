@props(['appointments', 'clients', 'services'])
@foreach($appointments as $appointment)
    <div x-show="openEdit === {{ $appointment->id }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40" style="display: none;">
        <div class="bg-white rounded-xl shadow-xl p-8 w-full max-w-md relative">
            <button @click="openEdit = null" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700">&times;</button>
            <h2 class="text-xl font-bold mb-4">Editar Agendamento</h2>
            <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="edit_client_id_{{ $appointment->id }}" class="block text-sm font-medium text-gray-700">Cliente</label>
                    <select name="client_id" id="edit_client_id_{{ $appointment->id }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="">Selecione</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ $appointment->client_id == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="edit_service_id_{{ $appointment->id }}" class="block text-sm font-medium text-gray-700">Serviço</label>
                    <select name="service_id" id="edit_service_id_{{ $appointment->id }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="">Selecione</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" {{ $appointment->service_id == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="edit_scheduled_at_{{ $appointment->id }}" class="block text-sm font-medium text-gray-700">Data e Hora</label>
                    <input type="datetime-local" name="scheduled_at" id="edit_scheduled_at_{{ $appointment->id }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required value="{{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('Y-m-d\\TH:i') }}">
                </div>
                <div class="mb-4">
                    <label for="edit_status_{{ $appointment->id }}" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="edit_status_{{ $appointment->id }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="pendente" {{ $appointment->status == 'pendente' ? 'selected' : '' }}>Pendente</option>
                        <option value="confirmado" {{ $appointment->status == 'confirmado' ? 'selected' : '' }}>Confirmado</option>
                        <option value="cancelado" {{ $appointment->status == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                        <option value="concluido" {{ $appointment->status == 'concluido' ? 'selected' : '' }}>Concluído</option>
                    </select>
                </div>
                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" @click="openEdit = null" class="px-4 py-2 bg-gray-100 text-gray-800 rounded hover:bg-gray-200 border border-gray-200">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded hover:bg-yellow-200 border border-yellow-200">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
@endforeach
