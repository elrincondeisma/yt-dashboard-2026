<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Informática',
                'slug' => 'informatica',
                'description' => 'Productos de tecnología y electrónica',
            ],
            [
                'name' => 'Coches',
                'slug' => 'coches',
                'description' => 'Accesorios y productos para vehículos',
            ],
            [
                'name' => 'Bienestar',
                'slug' => 'bienestar',
                'description' => 'Productos para el bienestar personal',
            ],
            [
                'name' => 'Salud',
                'slug' => 'salud',
                'description' => 'Productos relacionados con la salud',
            ],
            [
                'name' => 'Ocio',
                'slug' => 'ocio',
                'description' => 'Productos de entretenimiento y ocio',
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::create([
                'name' => $categoryData['name'],
                'slug' => $categoryData['slug'],
                'description' => $categoryData['description'],
                'parent_id' => null,
                'is_active' => true,
                'created_at' => now()->subDays(rand(30, 365)),
                'updated_at' => now()->subDays(rand(1, 30)),
            ]);
        }
    }
}
