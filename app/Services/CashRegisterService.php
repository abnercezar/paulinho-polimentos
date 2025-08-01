<?php

namespace App\Services;

use App\Models\CashRegister;
use App\Models\Service;
use App\Models\Client;
use App\Actions\CashRegister\CreateCashRegisterAction;
use App\Actions\CashRegister\UpdateCashRegisterAction;
use App\Actions\CashRegister\DeleteCashRegisterAction;
use App\Actions\CashRegister\GetCashRegisterSummaryAction;

class CashRegisterService
{
    /**
     * Cria um novo registro financeiro.
     */
    public function create(array $data): CashRegister
    {
        return (new CreateCashRegisterAction())->execute($data);
    }

    /**
     * Lista todos os registros financeiros paginados.
     */
    public function getPaginated(int $perPage = 15)
    {
        return CashRegister::with(['service', 'client'])
            ->orderByDesc('payment_date')
            ->paginate($perPage);
    }

    /**
     * Obtém o resumo financeiro (totais do dia, mês e pendentes).
     */
    public function getSummary(): array
    {
        return (new GetCashRegisterSummaryAction())->execute();
    }

    /**
     * Obtém os dados necessários para os formulários.
     */
    public function getFormData(): array
    {
        return [
            'services' => Service::all(),
            'clients' => Client::all(),
        ];
    }

    /**
     * Atualiza um registro financeiro existente.
     */
    public function update(CashRegister $cashRegister, array $data): CashRegister
    {
        return (new UpdateCashRegisterAction())->execute($cashRegister, $data);
    }

    /**
     * Exclui um registro financeiro.
     */
    public function delete(CashRegister $cashRegister): void
    {
        (new DeleteCashRegisterAction())->execute($cashRegister);
    }
}
