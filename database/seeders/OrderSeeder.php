<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::all();

        $customers->each(function ($customer) {
            $orderCount = rand(0, 5);

            for ($i = 0; $i < $orderCount; $i++) {
                $shippingAddress = $customer->shippingAddresses()->inRandomOrder()->first();

                Order::factory()->create([
                    'customer_id' => $customer->id,
                    'shipping_address_id' => $shippingAddress->id,
                ]);
            }
        });
    }
}
