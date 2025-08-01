<?php

namespace App\Actions\CashRegister;

use App\Models\CashRegister;

class UpdateCashRegisterAction
{
    /**
     * Executa a ação de atualizar um registro financeiro existente.
     */
    public function execute(CashRegister $cashRegister, array $data): CashRegister
    {
        // Limpa o status para evitar problemas de espaçamento
        if (isset($data['status'])) {
            $data['status'] = trim((string) $data['status']);
        }

        $cashRegister->update($data);

        return $cashRegister->fresh();
    }
}
