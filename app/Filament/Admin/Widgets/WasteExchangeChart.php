<?php

namespace App\Filament\Admin\Widgets;

use App\Models\WasteExchange;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class WasteExchangeChart extends ApexChartWidget
{
    protected static string $chartId = 'wasteExchangeChart';

    protected static ?string $heading = 'Waste Exchange History';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     */
    protected function getOptions(): array
    {

        $data = WasteExchange::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('SUM(weight) as total_weight')
        )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = $data->pluck('month')->toArray();
        $values = $data->pluck('total_weight')->toArray();

        return [
            'chart' => [
                'type' => 'area',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'WasteExchangeChart',
                    'data' => [2, 4, 6, 10, 14, 7, 2, 9, 10, 15, 13, 18],
                ],
            ],
            'xaxis' => [
                'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                        'fontWeight' => 600,
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'colors' => ['#34d399'],
            'stroke' => [
                'curve' => 'smooth',
            ],
        ];
    }
}
