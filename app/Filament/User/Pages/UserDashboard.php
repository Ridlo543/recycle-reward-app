<?php

namespace App\Filament\User\Pages;

use Filament\Facades\Filament;
use Filament\Pages\Page;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\User\Widgets\ExchangeWasteButton;
use App\Filament\User\Widgets\ExchangeWasteUserChart;

class UserDashboard extends BaseDashboard
{
    protected static string $routePath = '/';

    protected static ?int $navigationSort = -2;

    protected static string $view = 'filament-panels::pages.dashboard';

    public static function getNavigationLabel(): string
    {
        return static::$navigationLabel ??
            static::$title ??
            __('filament-panels::pages/dashboard.title');
    }

    public static function getNavigationIcon(): ?string
    {
        return static::$navigationIcon
            ?? (Filament::hasTopNavigation() ? 'heroicon-m-home' : 'heroicon-o-home');
    }

    public static function getRoutePath(): string
    {
        return static::$routePath;
    }

    public function getWidgets(): array
    {
        return [
            \Filament\Widgets\AccountWidget::class,
            ExchangeWasteUserChart::class,
            ExchangeWasteButton::class,
        ];
    }

    public function getVisibleWidgets(): array
    {
        return $this->filterVisibleWidgets($this->getWidgets());
    }

    public function getColumns(): int | string | array
    {
        return 1; // Full-width column
    }

    public function getTitle(): string | Htmlable
    {
        return static::$title ?? __('filament-panels::pages/dashboard.title');
    }
}
