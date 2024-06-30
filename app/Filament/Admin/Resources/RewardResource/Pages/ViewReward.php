<?php

namespace App\Filament\Admin\Resources\RewardResource\Pages;

use App\Filament\Admin\Resources\RewardResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewReward extends ViewRecord
{
    protected static string $resource = RewardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
