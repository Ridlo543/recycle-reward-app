<?php

namespace App\Filament\User\Widgets;

use Filament\Widgets\Widget;

class UserButton extends Widget
{
    protected static string $view = 'filament.user.widgets.user-button';
    protected int | string | array $columnSpan = 1;
}
