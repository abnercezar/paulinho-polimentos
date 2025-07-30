<?php

namespace Database\Factories;

use App\Models\CashRegister;
use App\Models\Service;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class CashRegisterFactory extends Factory
{
    protected $model = CashRegister::class;

    public function definition(): array
    {
        return [
            'service_id' => Service::inRandomOrder()->first()->id ?? 1,
            'client_id' => Client::inRandomOrder()->first()->id ?? 1,
            'amount' => $this->faker->randomFloat(2, 50, 500),
            'payment_type' => $this->faker->randomElement(['pix', 'cartao', 'dinheiro', 'pagar_em']),
            'status' => $this->faker->randomElement(['pago', 'em_aberto']),
            'payment_date' => $this->faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d'),
        ];
    }
}
