<?php

namespace App\Actions\CashRegister;

use App\Repositories\CashRegisterRepository;

class GetMonthlySummaryAction
{
    public function __construct(
        private CashRegisterRepository $repository
    ) {}

    public function execute(int $month = null, int $year = null): float
    {
        $month = $month ?? now()->month;
        $year = $year ?? now()->year;

        return $this->repository
            ->getPaidByMonth($month, $year)
            ->sum('amount');
    }
}
