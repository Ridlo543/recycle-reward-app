<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\Widget;

class AccountWidget extends Widget
{
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = -3;

    protected static bool $isLazy = false;

    /**
     * @var view-string
     */
    protected static string $view = 'filament-panels::widgets.account-widget';

    // public function getColumns(): int | string | array
    // {
    //     return 1;
    // }
}
