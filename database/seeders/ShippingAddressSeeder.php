<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\ShippingAddress;
use Illuminate\Database\Seeder;

class ShippingAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::all();

        $customers->each(function ($customer) {
            // Crear entre 1 y 3 direcciones de envío por cliente
            ShippingAddress::factory(rand(1, 3))->create([
                'customer_id' => $customer->id,
            ]);

            // Marcar la primera dirección como predeterminada
            $customer->shippingAddresses()->first()->update(['is_default' => true]);
        });
    }
}
