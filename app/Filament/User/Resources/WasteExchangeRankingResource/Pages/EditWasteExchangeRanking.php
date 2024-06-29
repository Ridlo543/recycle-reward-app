<?php

namespace App\Filament\User\Resources\WasteExchangeRankingResource\Pages;

use App\Filament\User\Resources\WasteExchangeRankingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWasteExchangeRanking extends EditRecord
{
    protected static string $resource = WasteExchangeRankingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
