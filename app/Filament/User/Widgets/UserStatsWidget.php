<?php

namespace App\Filament\User\Widgets;

use Carbon\Carbon;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\WasteExchange;

class UserStatsWidget extends BaseWidget
{
    use InteractsWithPageFilters;

    protected function getStats(): array
    {
        // Mengambil data untuk 3 bulan terakhir
        $threeMonthsAgo = Carbon::now()->subMonths(3);
        $currentUser = Auth::user();

        // Total poin user saat ini
        $totalPoints = $currentUser->points;

        // Total berat sampah yang sudah ditukarkan user
        $totalWeight = WasteExchange::where('user_id', $currentUser->id)
            ->where('status', 'accepted')
            ->sum('weight');
        $weightLastMonth = WasteExchange::where('user_id', $currentUser->id)
            ->where('status', 'accepted')
            ->where('created_at', '>=', $threeMonthsAgo->copy()->subMonth())
            ->sum('weight');
        $weightTwoMonthsAgo = WasteExchange::where('user_id', $currentUser->id)
            ->where('status', 'accepted')
            ->where('created_at', '>=', $threeMonthsAgo->copy()->subMonths(2))
            ->sum('weight');

        // Ranking user saat ini berdasarkan poin
        $userRank = User::where('points', '>', $currentUser->points)->count() + 1;

        // Fungsi untuk menghitung persentase perubahan
        $calculateChange = function ($current, $previous) {
            if ($previous == 0) {
                return $current > 0 ? 100 : 0;
            }
            return (($current - $previous) / $previous) * 100;
        };

        // Menghitung perubahan
        $weightChange = $calculateChange($totalWeight, $weightTwoMonthsAgo);

        // Menentukan warna berdasarkan perubahan
        $getColor = function ($change) {
            return $change >= 0 ? 'success' : 'danger';
        };

        return [
            Stat::make('Total Poin', $totalPoints)
                ->icon('heroicon-o-currency-dollar')
                ->chart([$totalPoints, $totalPoints, $totalPoints]) // Placeholder chart data
                ->color('success'), // Poin selalu positif, jadi warna hijau

            Stat::make('Total Berat Sampah', $totalWeight . ' kg')
                ->icon('heroicon-o-scale')
                ->description(abs($weightChange) . '% ' . ($weightChange >= 0 ? 'peningkatan' : 'penurunan'))
                ->descriptionIcon($weightChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->chart([$weightTwoMonthsAgo, $weightLastMonth, $totalWeight])
                ->color($getColor($weightChange)),

            Stat::make('Ranking Saat Ini', '#' . $userRank)
                ->icon('heroicon-o-trophy')
                ->chart([$userRank, $userRank, $userRank]) // Placeholder chart data
                ->color('success'), // Ranking lebih tinggi lebih baik, jadi warna hijau
        ];
    }
}
