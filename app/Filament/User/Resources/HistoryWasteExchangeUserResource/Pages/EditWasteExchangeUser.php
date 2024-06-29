<?php

namespace App\Filament\User\Resources\HistoryWasteExchangeUserResource\Pages;

use App\Filament\User\Resources\HistoryWasteExchangeUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWasteExchangeUser extends EditRecord
{
    protected static string $resource = HistoryWasteExchangeUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
