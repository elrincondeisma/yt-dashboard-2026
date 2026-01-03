<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();

        $products->each(function ($product) {
            // Crear una imagen principal
            ProductImage::factory(1)->primary()->create([
                'product_id' => $product->id,
            ]);

            // Crear entre 2 y 4 imágenes adicionales
            ProductImage::factory(rand(2, 4))->create([
                'product_id' => $product->id,
            ]);
        });
    }
}
