<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->words(3, true);
        $price = fake()->randomFloat(2, 10, 1000);
        $createdAt = fake()->dateTimeBetween('2025-01-01', 'now');

        return [
            'category_id' => \App\Models\Category::factory(),
            'name' => $name,
            'slug' => \Illuminate\Support\Str::slug($name),
            'description' => fake()->paragraph(),
            'price' => $price,
            'sale_price' => fake()->boolean(30) ? $price * 0.8 : null,
            'sku' => fake()->unique()->numerify('SKU-####-####'),
            'is_active' => true,
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }
}
