<?php

namespace App\Actions\CashRegister;

use App\Models\CashRegister;

class GetCashRegisterSummaryAction
{
    /**
     * Executa a ação de obter o resumo financeiro.
     */
    public function execute(): array
    {
        $today = now()->toDateString();

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

        return [
            'day' => $sumDay,
            'month' => $sumMonth,
            'pending' => $sumReceber,
        ];
    }
}
