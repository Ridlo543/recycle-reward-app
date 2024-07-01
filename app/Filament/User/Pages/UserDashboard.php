<?php

namespace App\Filament\User\Pages;

use Filament\Facades\Filament;
use Filament\Pages\Page;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\User\Widgets\ExchangeWasteButton;
use App\Filament\User\Widgets\ExchangeWasteUserChart;
use App\Filament\User\Widgets\UserButton;
use App\Filament\User\Widgets\UserStatsWidget;

class UserDashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $slug = 'dashboard';

    public function getColumns(): int | string | array
    {
        return 2; // Mengatur menjadi 2 kolom
    }
     public function getWidgets(): array
    {
        return [
            \Filament\Widgets\AccountWidget::class,
            UserButton::class,
            UserStatsWidget::class,
            ExchangeWasteUserChart::class,
        ];
    }

    // public function getWidgets(): array
    // {
    //     return [
    //         UserStatsWidget::class => ['columnSpan' => 'full'],
    //         ExchangeWasteUserChart::class => ['columnSpan' => 1],
    //         UserButton::class => ['columnSpan' => 1],
    //     ];
    // }
}
    // protected static string $routePath = '/';
    // protected static ?int $navigationSort = -2;
    // protected static string $view = 'filament-panels::pages.dashboard';

    // public static function getNavigationLabel(): string
    // {
    //     return static::$navigationLabel ??
    //         static::$title ??
    //         __('filament-panels::pages/dashboard.title');
    // }

    // public static function getNavigationIcon(): ?string
    // {
    //     return static::$navigationIcon
            // ?? (Filament::hasTopNavigation() ? 'heroicon-m-home' : 'heroicon-o-home');
    // }

    // public static function getRoutePath(): string
    // {
    //     return static::$routePath;
    // }

    // public function getWidgets(): array
    // {
    //     return [
    //         \Filament\Widgets\AccountWidget::class,
    //         ExchangeWasteUserChart::class,
    //         ExchangeWasteButton::class,
    //     ];
    // }

    // public function getVisibleWidgets(): array
    // {
    //     return $this->filterVisibleWidgets($this->getWidgets());
    // }
    // public function getTitle(): string | Htmlable
    // {
    //     return static::$title ?? __('filament-panels::pages/dashboard.title');
    // }