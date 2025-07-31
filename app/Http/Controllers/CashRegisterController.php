<?php

namespace App\Http\Controllers;

use App\Models\CashRegister;
use App\Models\Service;
use App\Models\Client;
use Illuminate\Http\Request;

class CashRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cashRegisters = CashRegister::with(['service', 'client'])->orderByDesc('payment_date')->paginate(15);

        $today = now()->toDateString();
        $month = now()->format('Y-m');

        // Pagos do dia
        $sumDay = CashRegister::whereDate('payment_date', $today)
            ->where('status', 'pago')
            ->sum('amount');

        // Pagos do mês (todos pagos no mês, incluindo os do dia)
        $sumMonth = CashRegister::whereMonth('payment_date', now()->month)
            ->whereYear('payment_date', now()->year)
            ->where('status', 'pago')
            ->sum('amount');

        // Em aberto (a receber, independente da data)
        $sumReceber = CashRegister::where('status', 'em_aberto')->sum('amount');

        $services = Service::all();
        $clients = Client::all();

        return view('cash_registers.index', compact('cashRegisters', 'sumDay', 'sumMonth', 'sumReceber', 'services', 'clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all();
        $clients = Client::all();
        return view('cash_registers.create', compact('services', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'service_id' => 'required|exists:services,id',
            'client_id' => 'required|exists:clients,id',
            'amount' => 'required|numeric|min:0',
            'payment_type' => 'required|string',
            'status' => 'required|string',
            'payment_date' => 'required|date',
        ]);
        CashRegister::create($data);
        return redirect()->route('cash_registers.index')->with('success', 'Registro financeiro criado com sucesso!');
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
    public function edit(CashRegister $cashRegister)
    {
        $services = Service::all();
        $clients = Client::all();
        return view('cash_registers.edit', compact('cashRegister', 'services', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CashRegister $cashRegister)
    {
        $data = $request->validate([
            'service_id' => 'required|exists:services,id',
            'client_id' => 'required|exists:clients,id',
            'amount' => 'required|numeric|min:0',
            'payment_type' => 'required|string',
            'status' => 'required|string',
            'payment_date' => 'required|date',
        ]);
        $cashRegister->update($data);
        return redirect()->route('cash_registers.index')->with('success', 'Registro financeiro atualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CashRegister $cashRegister)
    {
        $cashRegister->delete();
        return redirect()->route('cash_registers.index')->with('success', 'Registro removido!');
    }
}
