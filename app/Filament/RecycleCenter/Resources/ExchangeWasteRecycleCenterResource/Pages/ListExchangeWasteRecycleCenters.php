<?php

namespace App\Filament\RecycleCenter\Resources\ExchangeWasteRecycleCenterResource\Pages;

use App\Filament\RecycleCenter\Resources\ExchangeWasteRecycleCenterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExchangeWasteRecycleCenters extends ListRecords
{
    protected static string $resource = ExchangeWasteRecycleCenterResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\CreateAction::make(),
    //     ];
    // }
}
