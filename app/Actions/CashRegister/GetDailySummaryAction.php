<?php

namespace App\Actions\CashRegister;

use App\Repositories\CashRegisterRepository;

class GetDailySummaryAction
{
    public function __construct(
        private CashRegisterRepository $repository
    ) {}

    public function execute(string $date = null): float
    {
        $date = $date ?? now()->toDateString();

        return $this->repository
            ->getPaidByDate($date)
            ->sum('amount');
    }
}
