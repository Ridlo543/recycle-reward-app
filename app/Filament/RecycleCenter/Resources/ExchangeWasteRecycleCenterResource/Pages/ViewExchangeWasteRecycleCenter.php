<?php

namespace App\Filament\RecycleCenter\Resources\ExchangeWasteRecycleCenterResource\Pages;

use App\Filament\RecycleCenter\Resources\ExchangeWasteRecycleCenterResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewExchangeWasteRecycleCenter extends ViewRecord
{
    protected static string $resource = ExchangeWasteRecycleCenterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()->label('open'),
        ];
    }
}
