<?php

namespace App\Actions\CashRegister;

use App\Models\CashRegister;

class CreateCashRegisterAction
{
    /**
     * Executa a ação de criar um novo registro financeiro.
     */
    public function execute(array $data): CashRegister
    {
        // Aqui pode adicionar lógica extra, como eventos, validações customizadas, etc.
        return CashRegister::create($data);
    }
}
