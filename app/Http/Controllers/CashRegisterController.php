<?php

namespace App\Http\Controllers;

use App\Models\CashRegister;
use App\Services\CashRegisterService;
use App\Http\Requests\StoreCashRegisterRequest;

class CashRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CashRegisterService $cashRegisterService)
    {
        $cashRegisters = $cashRegisterService->getPaginated(15);
        $summary = $cashRegisterService->getSummary();
        $formData = $cashRegisterService->getFormData();

        return view('cash_registers.index', [
            'cashRegisters' => $cashRegisters,
            'sumDay' => $summary['day'],
            'sumMonth' => $summary['month'],
            'sumReceber' => $summary['pending'],
            'services' => $formData['services'],
            'clients' => $formData['clients'],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CashRegisterService $cashRegisterService)
    {
        $formData = $cashRegisterService->getFormData();

        return view('cash_registers.create', [
            'services' => $formData['services'],
            'clients' => $formData['clients'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCashRegisterRequest $request, CashRegisterService $cashRegisterService)
    {
        $cashRegisterService->create($request->validated());

        return redirect()->route('cash_registers.index')
            ->with('success', 'Registro financeiro criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CashRegister $cashRegister, CashRegisterService $cashRegisterService)
    {
        $formData = $cashRegisterService->getFormData();

        return view('cash_registers.edit', [
            'cashRegister' => $cashRegister,
            'services' => $formData['services'],
            'clients' => $formData['clients'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCashRegisterRequest $request, CashRegister $cashRegister, CashRegisterService $cashRegisterService)
    {
        $cashRegisterService->update($cashRegister, $request->validated());

        return redirect()->route('cash_registers.index')
            ->with('success', 'Registro financeiro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CashRegister $cashRegister, CashRegisterService $cashRegisterService)
    {
        $cashRegisterService->delete($cashRegister);

        return redirect()->route('cash_registers.index')
            ->with('success', 'Registro financeiro removido com sucesso!');
    }
}
