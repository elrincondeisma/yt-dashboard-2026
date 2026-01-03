<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subtotal = fake()->randomFloat(2, 50, 1000);
        $tax = $subtotal * 0.16;
        $shipping = fake()->randomFloat(2, 5, 20);
        $total = $subtotal + $tax + $shipping;
        $createdAt = fake()->dateTimeBetween('2025-01-01', 'now');

        return [
            'customer_id' => \App\Models\Customer::factory(),
            'order_number' => 'ORD-'.fake()->unique()->numerify('######'),
            'status' => fake()->randomElement(['pending', 'processing', 'shipped', 'delivered']),
            'subtotal' => $subtotal,
            'tax' => $tax,
            'shipping_cost' => $shipping,
            'total' => $total,
            'shipping_address_id' => \App\Models\ShippingAddress::factory(),
            'notes' => fake()->optional()->sentence(),
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }
}
