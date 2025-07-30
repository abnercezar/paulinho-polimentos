<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClientService;
use App\Http\Requests\StoreClientRequest;
use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Exibe o formulário de cadastro de cliente.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Salva um novo cliente no banco de dados.
     */
    public function store(StoreClientRequest $request, ClientService $clientService)
    {
        $clientService->create($request->validated());
        return redirect()->route('clients.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Lista todos os clientes.
     */
    public function index()
    {
        $clients = Client::paginate(15);
        return view('clients.index', compact('clients'));
    }

    /**
     * Exibe o formulário de edição de cliente.
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Atualiza um cliente existente.
     */
    public function update(StoreClientRequest $request, Client $client, ClientService $clientService)
    {
        $clientService->update($client, $request->validated());
        return redirect()->route('clients.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    /**
     * Exclui um cliente.
     */
    public function destroy(Client $client, ClientService $clientService)
    {
        $clientService->delete($client);
        return redirect()->route('clients.index')->with('success', 'Cliente excluído com sucesso!');
    }
}
