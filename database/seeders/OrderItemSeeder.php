<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::all();
        $products = Product::all();

        $orders->each(function ($order) use ($products) {
            // Crear entre 1 y 5 items por pedido
            $itemCount = rand(1, 5);

            for ($i = 0; $i < $itemCount; $i++) {
                OrderItem::factory()->create([
                    'order_id' => $order->id,
                    'product_id' => $products->random()->id,
                ]);
            }

            // Crear pago para el pedido
            Payment::factory()->create([
                'order_id' => $order->id,
                'amount' => $order->total,
            ]);
        });
    }
}
