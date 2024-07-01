<?php

namespace App\Filament\RecycleCenter\Widgets;

use Carbon\Carbon;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use App\Models\WasteExchange;

class RecycleCenterStatsOverview extends BaseWidget
{
    use InteractsWithPageFilters;
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        // Mengambil data untuk 3 bulan terakhir
        $threeMonthsAgo = Carbon::now()->subMonths(3);
        $currentCenter = Auth::guard('recycling_center')->user();

        if (!$currentCenter) {
            return [];
        }

        // Total waste exchanges
        $totalWasteExchanges = WasteExchange::where('recycling_center_id', $currentCenter->id)->count();
        $wasteExchangesLastMonth = WasteExchange::where('recycling_center_id', $currentCenter->id)
            ->where('created_at', '>=', $threeMonthsAgo->copy()->subMonth())
            ->count();
        $wasteExchangesTwoMonthsAgo = WasteExchange::where('recycling_center_id', $currentCenter->id)
            ->where('created_at', '>=', $threeMonthsAgo->copy()->subMonths(2))
            ->count();

        // Fungsi untuk menghitung persentase perubahan
        $calculateChange = function ($current, $previous) {
            if ($previous == 0) {
                return $current > 0 ? 100 : 0;
            }
            return (($current - $previous) / $previous) * 100;
        };

        // Menghitung perubahan
        $wasteExchangesChange = $calculateChange($totalWasteExchanges, $wasteExchangesTwoMonthsAgo);

        // Menentukan warna berdasarkan perubahan
        $getColor = function ($change) {
            return $change >= 0 ? 'success' : 'danger';
        };

        return [
            Stat::make('Total Tukar Sampah', $totalWasteExchanges)
                ->description(abs($wasteExchangesChange) . '% ' . ($wasteExchangesChange >= 0 ? 'peningkatan' : 'penurunan'))
                ->descriptionIcon($wasteExchangesChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->chart([$wasteExchangesTwoMonthsAgo, $wasteExchangesLastMonth, $totalWasteExchanges])
                ->color($getColor($wasteExchangesChange)),
        ];
    }
}
