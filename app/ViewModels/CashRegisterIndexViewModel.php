<?php

namespace App\ViewModels;

use App\Services\CashRegisterService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CashRegisterIndexViewModel
{
    public function __construct(
        private CashRegisterService $cashRegisterService
    ) {}

    public function toArray(): array
    {
        $cashRegisters = $this->cashRegisterService->getPaginated(15);
        $summary = $this->cashRegisterService->getSummary();
        $formData = $this->cashRegisterService->getFormData();

        return [
            'cashRegisters' => $cashRegisters,
            'summary' => [
                'day' => $summary['day'],
                'month' => $summary['month'],
                'pending' => $summary['pending'],
            ],
            'formData' => [
                'services' => $formData['services'],
                'clients' => $formData['clients'],
            ],
        ];
    }
}
