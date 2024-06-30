<?php

namespace App\Filament\User\Resources\RedeemRewardUserResource\Pages;

use App\Filament\User\Resources\RedeemRewardUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRedeemRewardUser extends EditRecord
{
    protected static string $resource = RedeemRewardUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
