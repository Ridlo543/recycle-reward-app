<?php

namespace App\Providers\Filament;

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
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Leandrocfe\FilamentApexCharts\FilamentApexChartsPlugin;
use Njxqlus\FilamentProgressbar\FilamentProgressbarPlugin;
use SolutionForest\FilamentSimpleLightBox\SimpleLightBoxPlugin;

class RecycleCenterPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->brandName('Recycle Reward App')
            ->id('recycleCenter')
            ->path('recycleCenter')
            ->login()
            // ->registration()
            ->passwordReset()
            ->profile()
            ->sidebarCollapsibleOnDesktop()
            ->databaseNotifications()
            ->databaseNotificationsPolling('15s')
            ->discoverResources(in: app_path('Filament/RecycleCenter/Resources'), for: 'App\\Filament\\RecycleCenter\\Resources')
            ->discoverPages(in: app_path('Filament/RecycleCenter/Pages'), for: 'App\\Filament\\RecycleCenter\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/RecycleCenter/Widgets'), for: 'App\\Filament\\RecycleCenter\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
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
            ->authGuard('recycling_center')
            ->databaseNotifications();
    }
}
