<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'scheduled_at' => $this->faker->dateTimeBetween('now', '+30 days'),
            'duration_minutes' => $this->faker->numberBetween(30, 180),
            'status' => $this->faker->randomElement(['pendente', 'confirmado', 'cancelado']),
        ];
    }
}
