<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Carbon;

class RevenueChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected ?string $heading = 'Ingresos por Mes';

    protected static ?int $sort = 3;


    protected function getData(): array
    {
        $startDate = $this->filters['startDate'] ?? now()->subYear();
        $endDate = $this->filters['endDate'] ?? now();

        $data = Order::query()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw("strftime('%Y-%m', created_at) as month, SUM(total) as revenue")
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Ingresos ($)',
                    'data' => $data->pluck('revenue')->map(fn ($value) => round((float) $value, 2))->toArray(),
                    'backgroundColor' => 'rgba(34, 197, 94, 0.8)',
                    'borderColor' => 'rgb(34, 197, 94)',
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
        return 'bar';
    }
}
