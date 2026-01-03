<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $createdAt = fake()->dateTimeBetween('2025-01-01', 'now');

        return [
            'customer_id' => \App\Models\Customer::factory(),
            'session_id' => null,
            'expires_at' => now()->addDays(7),
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }

    public function guest(): static
    {
        return $this->state(fn (array $attributes) => [
            'customer_id' => null,
            'session_id' => fake()->uuid(),
        ]);
    }
}
