<?php

namespace App\Filament\Admin\Widgets;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class UsersCountChart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'usersCountChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Jumlah Pengguna';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        // Dapatkan data jumlah pengguna per bulan
        $data = User::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(id) as total_users')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        // Siapkan data untuk grafik
        $seriesData = [];

        foreach ($months as $index => $month) {
            $record = $data->firstWhere('month', $index + 1);
            $seriesData[] = $record ? $record->total_users : 0;
        }

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'Jumlah Pengguna',
                    'data' => $seriesData,
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
            'colors' => ['#4ade80'],
        ];
    }

    public function getColumnSpan(): int
    {
        return 1; // Setengah lebar kolom
    }
}