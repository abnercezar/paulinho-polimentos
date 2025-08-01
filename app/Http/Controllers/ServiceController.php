<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ServiceService;
use App\Http\Requests\StoreServiceRequest;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Exibe o formulário de cadastro de serviço.
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Salva um novo serviço no banco de dados.
     */
    public function store(StoreServiceRequest $request, ServiceService $serviceService)
    {
        $serviceService->create($request->validated());
        return redirect()->route('services.index')->with('success', 'Serviço cadastrado com sucesso!');
    }

    /**
     * Lista todos os serviços.
     */
    public function index(ServiceService $serviceService)
    {
        $services = $serviceService->getPaginated(15);
        return view('services.index', compact('services'));
    }

    /**
     * Exibe o formulário de edição de serviço.
     */
    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    /**
     * Atualiza um serviço existente.
     */
    public function update(StoreServiceRequest $request, Service $service, ServiceService $serviceService)
    {
        $serviceService->update($service, $request->validated());
        return redirect()->route('services.index')->with('success', 'Serviço atualizado com sucesso!');
    }

    /**
     * Exclui um serviço.
     */
    public function destroy(Service $service, ServiceService $serviceService)
    {
        $serviceService->delete($service);
        return redirect()->route('services.index')->with('success', 'Serviço excluído com sucesso!');
    }
}
