<?php

namespace App\Filament\Resources\WasteExchangeResource\Pages;

use App\Filament\Resources\WasteExchangeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWasteExchange extends EditRecord
{
    protected static string $resource = WasteExchangeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
