<?php

namespace App\Actions\CashRegister;

use App\Models\CashRegister;

class DeleteCashRegisterAction
{
    /**
     * Executa a ação de excluir um registro financeiro.
     */
    public function execute(CashRegister $cashRegister): void
    {
        $cashRegister->delete();
    }
}
