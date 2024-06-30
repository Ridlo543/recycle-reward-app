<?php

namespace App\Filament\User\Resources\RedeemRewardUserResource\Pages;

use App\Filament\User\Resources\RedeemRewardUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRedeemRewardUsers extends ListRecords
{
    protected static string $resource = RedeemRewardUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
