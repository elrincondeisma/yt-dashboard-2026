<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Carbon;

class CustomersChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected ?string $heading = 'Nuevos Clientes por Mes';

    protected static ?int $sort = 5;


    protected function getData(): array
    {
        $startDate = $this->filters['startDate'] ?? now()->subYear();
        $endDate = $this->filters['endDate'] ?? now();

        $data = Customer::query()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw("strftime('%Y-%m', created_at) as month, COUNT(*) as count")
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Nuevos Clientes',
                    'data' => $data->pluck('count')->toArray(),
                    'borderColor' => 'rgb(34, 197, 94)',
                    'backgroundColor' => 'rgba(34, 197, 94, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $data->map(function ($item) {
                $date = Carbon::createFromFormat('Y-m', $item->month);

                return $date->locale('es')->translatedFormat('M Y');
            })->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
