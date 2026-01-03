<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Carbon;

class OrdersChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected ?string $heading = 'Pedidos por Mes';

    protected static ?int $sort = 2;


    protected function getData(): array
    {
        $startDate = $this->filters['startDate'] ?? now()->subYear();
        $endDate = $this->filters['endDate'] ?? now();

        // SQLite usa strftime para agrupar por mes
        $data = Order::query()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw("strftime('%Y-%m', created_at) as month, COUNT(*) as count")
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Pedidos',
                    'data' => $data->pluck('count')->toArray(),
                    'borderColor' => 'rgb(59, 130, 246)',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $data->map(function ($item) {
                // Convertir 2025-01 a "Ene 2025"
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
