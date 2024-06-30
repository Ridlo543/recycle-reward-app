<?php

namespace App\Filament\Admin\Resources\HistoryRewardUserResource\Pages;

use App\Filament\Admin\Resources\HistoryRewardUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHistoryRewardUser extends EditRecord
{
    protected static string $resource = HistoryRewardUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
