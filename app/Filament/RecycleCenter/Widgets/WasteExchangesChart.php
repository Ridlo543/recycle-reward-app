<?php

namespace App\Filament\RecycleCenter\Widgets;

use App\Models\WasteExchange;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class WasteExchangesChart extends ApexChartWidget
{

    protected int | string | array $columnSpan = 'full';
    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'wasteExchangesChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'History Pertukaran Sampah';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $currentCenter = Auth::guard('recycling_center')->user();

        // Fetch waste exchanges data 
        $wasteExchanges = WasteExchange::where('recycling_center_id', $currentCenter->id)
            // ->where('created_at', '>=', $threeMonthsAgo)
            ->orderBy('created_at')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('M');
            });

        // $categories = [];
        $data = [];
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        // foreach ($wasteExchanges as $month => $wasteExchange) {
        //     // $categories[] = $month;
        //     $data[] = $wasteExchange->count();
        // }

        foreach ($months as $month) {
            $data[] = $wasteExchanges->has($month) ? $wasteExchanges[$month]->count() : 0;
        }

        return [
            'chart' => [
                'type' => 'area',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'Waste Exchanges',
                    'data' => $data,
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
            'colors' => ['#f59e0b'],
        ];
    }
}
