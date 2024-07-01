<?php

namespace App\Filament\Admin\Widgets;

use App\Models\RecyclingCenter;
use App\Models\User;
use App\Models\WasteExchange;
use Carbon\Carbon;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminStatsOverview extends BaseWidget
{
    use InteractsWithPageFilters;

    protected function getStats(): array
    {
        // Mengambil data untuk 3 bulan terakhir
        $threeMonthsAgo = Carbon::now()->subMonths(3);

        // Jumlah pengguna
        $users = User::count();
        $usersLastMonth = User::where('created_at', '>=', $threeMonthsAgo->copy()->subMonth())->count();
        $usersTwoMonthsAgo = User::where('created_at', '>=', $threeMonthsAgo->copy()->subMonths(2))->count();

        // Jumlah Tukar Sampah
        $wasteExchanges = WasteExchange::count();
        $wasteExchangesLastMonth = WasteExchange::where('created_at', '>=', $threeMonthsAgo->copy()->subMonth())->count();
        $wasteExchangesTwoMonthsAgo = WasteExchange::where('created_at', '>=', $threeMonthsAgo->copy()->subMonths(2))->count();

        // Jumlah Recycling Center
        $recyclingCenters = RecyclingCenter::count();
        $recyclingCentersLastMonth = RecyclingCenter::where('created_at', '>=', $threeMonthsAgo->copy()->subMonth())->count();
        $recyclingCentersTwoMonthsAgo = RecyclingCenter::where('created_at', '>=', $threeMonthsAgo->copy()->subMonths(2))->count();

        // Fungsi untuk menghitung persentase perubahan
        $calculateChange = function ($current, $previous) {
            if ($previous == 0) {
                return $current > 0 ? 100 : 0;
            }
            return (($current - $previous) / $previous) * 100;
        };

        // Menghitung perubahan
        $userChange = $calculateChange($users, $usersTwoMonthsAgo);
        $wasteExchangesChange = $calculateChange($wasteExchanges, $wasteExchangesTwoMonthsAgo);
        $recyclingCentersChange = $calculateChange($recyclingCenters, $recyclingCentersTwoMonthsAgo);

        // Menentukan warna berdasarkan perubahan
        $getColor = function ($change) {
            return $change >= 0 ? 'success' : 'danger';
        };

        return [
            Stat::make('Jumlah Pengguna', $users)
                ->description(abs($userChange) . '% ' . ($userChange >= 0 ? 'peningkatan' : 'penurunan'))
                ->descriptionIcon($userChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->chart([$usersTwoMonthsAgo, $usersLastMonth, $users])
                ->color($getColor($userChange)),

            Stat::make('Jumlah Tukar Sampah', $wasteExchanges)
                ->description(abs($wasteExchangesChange) . '% ' . ($wasteExchangesChange >= 0 ? 'peningkatan' : 'penurunan'))
                ->descriptionIcon($wasteExchangesChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->chart([$wasteExchangesTwoMonthsAgo, $wasteExchangesLastMonth, $wasteExchanges])
                ->color($getColor($wasteExchangesChange)),

            Stat::make('Jumlah Recycling Center', $recyclingCenters)
                ->description(abs($recyclingCentersChange) . '% ' . ($recyclingCentersChange >= 0 ? 'peningkatan' : 'penurunan'))
                ->descriptionIcon($recyclingCentersChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->chart([$recyclingCentersTwoMonthsAgo, $recyclingCentersLastMonth, $recyclingCenters])
                ->color($getColor($recyclingCentersChange)),
        ];
    }
}
