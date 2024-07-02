<?php
// app/Providers/Filament/AdminPanelProvider.php
namespace App\Providers\Filament;

use App\Filament\Admin\Pages\AdminDashboard;
use App\Filament\Admin\Widgets\AccountWidget;
use App\Filament\Admin\Widgets\UsersCountChart;
use App\Filament\Admin\Resources\AdminResource;
use App\Filament\Admin\Resources\PartnerResource;
use App\Filament\Admin\Resources\RecyclingCenterResource;
use App\Filament\Admin\Resources\UserResource;
use App\Filament\Admin\Resources\WasteExchangeResource;
use App\Filament\Admin\Resources\WasteTypeResource;
use App\Filament\Admin\Widgets\WasteExchangeChart;
use App\Http\Middleware\AdminMiddleware;
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
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Leandrocfe\FilamentApexCharts\FilamentApexChartsPlugin;
use Njxqlus\FilamentProgressbar\FilamentProgressbarPlugin;
use SolutionForest\FilamentSimpleLightBox\SimpleLightBoxPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->brandName('Recycle Reward App')
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->profile()
            ->databaseNotifications()
            ->databaseNotificationsPolling('5s')
            ->sidebarCollapsibleOnDesktop()
            ->colors([
                'primary' => Color::Green,
            ])
            ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\\Filament\\Admin\\Resources')
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\\Filament\\Admin\\Pages')
            ->pages([
                // Pages\Dashboard::class,
                AdminDashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Admin/Widgets'), for: 'App\\Filament\\Admin\\Widgets')
            ->widgets([
                AccountWidget::class,
            ])
            ->plugins(
                [
                    \Hasnayeen\Themes\ThemesPlugin::make(),
                    FilamentApexChartsPlugin::make(),
                    FilamentProgressbarPlugin::make()->color('#38af39'),
                    SimpleLightBoxPlugin::make(),
                ]
            )
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
            ->authGuard('admin');
    }
}
    
                // Widgets\FilamentInfoWidget::class,
    // ->authMiddleware([
    //     Authenticate::class,
    // ]);
    // ->authMiddleware([
    //     AdminMiddleware::class,
    // ]);