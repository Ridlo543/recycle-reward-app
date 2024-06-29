<?php

namespace App\Filament\User\Resources\HistoryWasteExchangeUserResource\Pages;

use App\Filament\User\Resources\HistoryWasteExchangeUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWasteExchangeUsers extends ListRecords
{
    protected static string $resource = HistoryWasteExchangeUserResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\CreateAction::make(),
    //     ];
    // }
}
