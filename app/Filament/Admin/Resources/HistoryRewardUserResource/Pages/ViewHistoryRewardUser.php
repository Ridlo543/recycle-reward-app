<?php

namespace App\Filament\Admin\Resources\HistoryRewardUserResource\Pages;

use App\Filament\Admin\Resources\HistoryRewardUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewHistoryRewardUser extends ViewRecord
{
    protected static string $resource = HistoryRewardUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
