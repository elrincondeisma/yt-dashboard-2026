<?php

namespace Database\Seeders;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startDate = Carbon::parse('2025-01-01');
        $endDate = now();

        $currentDate = $startDate->copy();

        // Iterar por cada mes desde enero 2025 hasta hoy
        while ($currentDate->lessThanOrEqualTo($endDate)) {
            // Crear entre 1 y 10 clientes por mes
            $customersCount = rand(1, 10);

            for ($i = 0; $i < $customersCount; $i++) {
                // Generar fecha aleatoria dentro del mes actual
                $randomDay = rand(1, $currentDate->daysInMonth);
                $customerDate = $currentDate->copy()->day(min($randomDay, $currentDate->daysInMonth));

                // Asegurar que no exceda la fecha final
                if ($customerDate->greaterThan($endDate)) {
                    $customerDate = $endDate->copy();
                }

                Customer::factory()->create([
                    'created_at' => $customerDate,
                    'updated_at' => $customerDate,
                    'email_verified_at' => $customerDate,
                ]);
            }

            // Avanzar al siguiente mes
            $currentDate->addMonth()->startOfMonth();
        }
    }
}
