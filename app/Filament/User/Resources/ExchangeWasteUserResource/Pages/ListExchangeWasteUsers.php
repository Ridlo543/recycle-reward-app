<?php

namespace App\Filament\User\Resources\ExchangeWasteUserResource\Pages;

use App\Filament\User\Resources\ExchangeWasteUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExchangeWasteUsers extends ListRecords
{
    protected static string $resource = ExchangeWasteUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
