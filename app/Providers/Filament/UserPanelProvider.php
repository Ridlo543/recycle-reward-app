<?php

namespace App\Providers\Filament;

use App\Filament\Admin\Resources\HistoryWasteExchangeUserResource;
use App\Filament\User\Pages\UserDashboard;
use App\Filament\User\Resources\HistoryWasteExchangeUserResource as ResourcesHistoryWasteExchangeUserResource;
// use App\Filament\User\Pages\WasteExchange;
use App\Filament\User\Widgets\ExchangeWasteButton;
use App\Filament\User\Widgets\ExchangeWasteUserChart;
use App\Filament\User\Widgets\UserButton;
use App\Filament\User\Widgets\UserStatsWidget;
use App\Filament\User\Pages\Auth\UserRegister;
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
use Njxqlus\FilamentProgressbar\FilamentProgressbarPlugin;
use SolutionForest\FilamentSimpleLightBox\SimpleLightBoxPlugin;

class UserPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('user')
            ->path('user')
            ->brandName('Recycle Reward App')
            ->login()
            ->registration(UserRegister::class)
            ->passwordReset()
            ->emailVerification()
            ->profile()
            ->sidebarCollapsibleOnDesktop()
            ->discoverResources(in: app_path('Filament/User/Resources'), for: 'App\\Filament\\User\\Resources')
            ->discoverPages(in: app_path('Filament/User/Pages'), for: 'App\\Filament\\User\\Pages')
            ->pages([
                UserDashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/User/Widgets'), for: 'App\\Filament\\User\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                UserButton::class,
                UserStatsWidget::class,
                ExchangeWasteUserChart::class,
            ])
            ->plugins([
                \Hasnayeen\Themes\ThemesPlugin::make()
                    ->canViewThemesPage(fn () => Auth::guard('admin')->check()),
                FilamentApexChartsPlugin::make(),
                FilamentProgressbarPlugin::make()->color('#38af39'),
                SimpleLightBoxPlugin::make(),
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
