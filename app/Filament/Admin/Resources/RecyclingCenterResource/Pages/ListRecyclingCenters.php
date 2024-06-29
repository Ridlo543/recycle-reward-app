<?php

namespace App\Filament\Admin\Resources\RecyclingCenterResource\Pages;

use App\Filament\Admin\Resources\RecyclingCenterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRecyclingCenters extends ListRecords
{
    protected static string $resource = RecyclingCenterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
