<?php

namespace App\Filament\User\Widgets;

use App\Models\WasteExchange;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class ExchangeWasteUserChart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'exchangeWasteUserChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'ExchangeWasteUserChart';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $user = Auth::user();

        // Dapatkan data pertukaran sampah per bulan untuk user saat ini
        $data = WasteExchange::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(weight) as total_weight'),
            DB::raw('SUM(points) as total_points')
        )
            ->where('user_id', $user->id)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        // Siapkan data untuk grafik
        $seriesDataWeight = [];
        $seriesDataPoints = [];

        foreach ($months as $index => $month) {
            $record = $data->firstWhere('month', $index + 1);
            $seriesDataWeight[] = $record ? $record->total_weight : 0;
            $seriesDataPoints[] = $record ? $record->total_points : 0;
        }

        return [
            'chart' => [
                'type' => 'bar', // Ganti dengan tipe grafik yang diinginkan
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'Total Berat (grams)',
                    'data' => $seriesDataWeight,
                ],
                [
                    'name' => 'Total Poin',
                    'data' => $seriesDataPoints,
                ],
            ],
            'xaxis' => [
                'categories' => $months,
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
            'colors' => ['#4ade80', '#60a5fa'],
        ];
    }
}
