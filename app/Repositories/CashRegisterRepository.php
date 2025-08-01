<?php

namespace App\Repositories;

use App\Models\CashRegister;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CashRegisterRepository
{
    public function __construct(
        private CashRegister $model
    ) {}

    public function getPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model
            ->with(['service', 'client'])
            ->orderByDesc('payment_date')
            ->paginate($perPage);
    }

    public function getPaidByDate(string $date): Collection
    {
        return $this->model
            ->whereDate('payment_date', $date)
            ->where('status', 'pago')
            ->get();
    }

    public function getPaidByMonth(int $month, int $year): Collection
    {
        return $this->model
            ->whereMonth('payment_date', $month)
            ->whereYear('payment_date', $year)
            ->where('status', 'pago')
            ->get();
    }

    public function getPending(): Collection
    {
        return $this->model
            ->where('status', 'em_aberto')
            ->get();
    }

    public function create(array $data): CashRegister
    {
        return $this->model->create($data);
    }

    public function update(CashRegister $cashRegister, array $data): CashRegister
    {
        $cashRegister->update($data);
        return $cashRegister->fresh();
    }

    public function delete(CashRegister $cashRegister): bool
    {
        return $cashRegister->delete();
    }
}
