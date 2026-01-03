<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::all();
        $products = Product::all();

        // Crear carritos para 10 clientes aleatorios
        $customers->random(10)->each(function ($customer) use ($products) {
            $cart = Cart::factory()->create([
                'customer_id' => $customer->id,
            ]);

            // Agregar entre 1 y 3 items al carrito
            $itemCount = rand(1, 3);
            for ($i = 0; $i < $itemCount; $i++) {
                CartItem::factory()->create([
                    'cart_id' => $cart->id,
                    'product_id' => $products->random()->id,
                ]);
            }
        });

        // Crear 5 carritos de invitados
        Cart::factory(5)->guest()->create()->each(function ($cart) use ($products) {
            CartItem::factory(rand(1, 3))->create([
                'cart_id' => $cart->id,
                'product_id' => $products->random()->id,
            ]);
        });
    }
}
