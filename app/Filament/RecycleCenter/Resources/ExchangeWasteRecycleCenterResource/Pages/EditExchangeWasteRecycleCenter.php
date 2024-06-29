<?php

namespace App\Filament\RecycleCenter\Resources\ExchangeWasteRecycleCenterResource\Pages;

use App\Filament\RecycleCenter\Resources\ExchangeWasteRecycleCenterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExchangeWasteRecycleCenter extends EditRecord
{
    protected static string $resource = ExchangeWasteRecycleCenterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
