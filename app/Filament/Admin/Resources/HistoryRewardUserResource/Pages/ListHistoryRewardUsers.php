<?php

namespace App\Filament\Admin\Resources\HistoryRewardUserResource\Pages;

use App\Filament\Admin\Resources\HistoryRewardUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
// use pxlrbt\FilamentExcel\Actions\Tables\ExportAction as ExcelExportAction;

class ListHistoryRewardUsers extends ListRecords
{
    protected static string $resource = HistoryRewardUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            // ExcelExportAction::make(),
        ];
    }
}
