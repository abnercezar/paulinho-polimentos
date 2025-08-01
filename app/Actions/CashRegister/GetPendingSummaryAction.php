<?php

namespace App\Actions\CashRegister;

use App\Repositories\CashRegisterRepository;

class GetPendingSummaryAction
{
    public function __construct(
        private CashRegisterRepository $repository
    ) {}

    public function execute(): float
    {
        return $this->repository
            ->getPending()
            ->sum('amount');
    }
}
