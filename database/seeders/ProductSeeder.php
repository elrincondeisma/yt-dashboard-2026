<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        // Crear 50 productos con categorías aleatorias
        Product::factory(50)->create([
            'category_id' => fn () => $categories->random()->id,
        ]);
    }
}
