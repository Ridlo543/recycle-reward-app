<?php

namespace App\Providers\Filament;

use App\Filament\User\Pages\ExchangeWaste;
use App\Filament\User\Pages\UserDashboard;
// use App\Filament\User\Pages\WasteExchange;
use App\Filament\User\Widgets\ExchangeWasteButton;
use App\Filament\User\Widgets\ExchangeWasteUserChart;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use Leandrocfe\FilamentApexCharts\FilamentApexChartsPlugin;

class UserPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        // dd(Color::Green);
        return $panel
            ->id('user')
            ->path('user')
            ->login()
            ->registration()
            ->passwordReset()
            ->emailVerification()
            // ->colors([
            //     'danger' => Color::Red,
            //     'gray' => Color::Zinc,
            //     'info' => Color::Blue,
            //     'primary' => Color::Green,
            //     'success' => Color::Green,
            //     'warning' => Color::Amber,
            // ])
            ->profile()
            ->sidebarCollapsibleOnDesktop()
            ->discoverResources(in: app_path('Filament/User/Resources'), for: 'App\\Filament\\User\\Resources')
            ->discoverPages(in: app_path('Filament/User/Pages'), for: 'App\\Filament\\User\\Pages')
            ->pages([
                UserDashboard::class,
                ExchangeWaste::class,
            ])
            ->discoverWidgets(in: app_path('Filament/User/Widgets'), for: 'App\\Filament\\User\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
                ExchangeWasteUserChart::class,
                ExchangeWasteButton::class,
            ])
            ->plugins([
                \Hasnayeen\Themes\ThemesPlugin::make()
                    ->canViewThemesPage(fn () => Auth::guard('admin')->check()),
                FilamentApexChartsPlugin::make(),
            ])
            ->middleware([
                \Hasnayeen\Themes\Http\Middleware\SetTheme::class,
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
        // ->authGuard(
        //     'user'
        // );
    }
}
