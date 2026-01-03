<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = fake()->randomElement(['pending', 'completed', 'failed']);

        return [
            'order_id' => \App\Models\Order::factory(),
            'payment_method' => fake()->randomElement(['credit_card', 'debit_card', 'paypal', 'bank_transfer', 'cash_on_delivery']),
            'transaction_id' => $status === 'completed' ? fake()->uuid() : null,
            'amount' => fake()->randomFloat(2, 50, 1000),
            'status' => $status,
            'paid_at' => $status === 'completed' ? now() : null,
        ];
    }
}
