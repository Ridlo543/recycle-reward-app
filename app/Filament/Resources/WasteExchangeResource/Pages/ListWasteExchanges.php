<?php

namespace App\Filament\Resources\WasteExchangeResource\Pages;

use App\Filament\Resources\WasteExchangeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWasteExchanges extends ListRecords
{
    protected static string $resource = WasteExchangeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
