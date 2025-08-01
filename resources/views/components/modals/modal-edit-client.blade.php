@foreach($clients as $client)
    <div x-show="openEdit === {{ $client->id }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40" style="display: none;">
        <div class="bg-white rounded-xl shadow-xl p-8 w-full max-w-md relative">
            <button @click="openEdit = null" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700">&times;</button>
            <h2 class="text-xl font-bold mb-4">Editar Cliente</h2>
            <form action="{{ route('clients.update', $client->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="edit_name_{{ $client->id }}" class="block text-sm font-medium text-gray-700">Nome</label>
                    <input type="text" name="name" id="edit_name_{{ $client->id }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required value="{{ $client->name }}">
                </div>
                <div class="mb-4">
                    <label for="edit_email_{{ $client->id }}" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="edit_email_{{ $client->id }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ $client->email }}">
                </div>
                <div class="mb-4">
                    <label for="edit_phone_{{ $client->id }}" class="block text-sm font-medium text-gray-700">Telefone</label>
                    <input type="text" name="phone" id="edit_phone_{{ $client->id }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ $client->phone }}">
                </div>
                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" @click="openEdit = null" class="px-4 py-2 bg-gray-100 text-gray-800 rounded hover:bg-gray-200 border border-gray-200">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded hover:bg-yellow-200 border border-yellow-200">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
@endforeach
