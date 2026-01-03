<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $startDate = $this->pageFilters['startDate'] ?? null;
        $endDate = $this->pageFilters['endDate'] ?? null;
        $customers = Customer::query()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();
        $orders = Order::query()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();
        $products = Product::query()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();
        $revenue = Order::query()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('total');

        return [
            Stat::make('Total Clientes', $customers)
                ->description('Clientes registrados')
                ->descriptionIcon('heroicon-m-user-group')
                ->chart($this->getCustomerChartData())
                ->color('success'),

            Stat::make('Total Pedidos', $orders)
                ->description('Pedidos realizados')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->chart($this->getOrderChartData())
                ->color('info'),

            Stat::make('Total Productos', $products)
                ->description('Productos en catálogo')
                ->descriptionIcon('heroicon-m-cube')
                ->chart($this->getProductChartData())
                ->color('warning'),

            Stat::make('Total Ingresos', '$'.number_format($revenue, 2))
                ->description('Ingresos totales')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->chart($this->getRevenueChartData())
                ->color('success'),
        ];
    }

    protected function getCustomerChartData(): array
    {
        $startDate = $this->pageFilters['startDate'] ?? null;
        $endDate = $this->pageFilters['endDate'] ?? null;

        return Customer::query()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('COUNT(*) as count')
            ->orderBy('created_at')
            ->take(7)
            ->pluck('count')
            ->toArray();
    }

    protected function getOrderChartData(): array
    {
        $startDate = $this->pageFilters['startDate'] ?? null;
        $endDate = $this->pageFilters['endDate'] ?? null;

        return Order::query()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('COUNT(*) as count')
            ->orderBy('created_at')
            ->take(7)
            ->pluck('count')
            ->toArray();
    }

    protected function getProductChartData(): array
    {
        $startDate = $this->pageFilters['startDate'] ?? null;
        $endDate = $this->pageFilters['endDate'] ?? null;

        return Product::query()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('COUNT(*) as count')
            ->orderBy('created_at')
            ->take(7)
            ->pluck('count')
            ->toArray();
    }

    protected function getRevenueChartData(): array
    {
        $startDate = $this->pageFilters['startDate'] ?? null;
        $endDate = $this->pageFilters['endDate'] ?? null;

        return Order::query()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('SUM(total) as revenue')
            ->orderBy('created_at')
            ->take(7)
            ->pluck('revenue')
            ->map(fn ($value) => (float) $value)
            ->toArray();
    }
}
