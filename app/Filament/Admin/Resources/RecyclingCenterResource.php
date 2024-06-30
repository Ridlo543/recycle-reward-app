<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RecyclingCenterResource\Pages;
use App\Filament\Admin\Resources\RecyclingCenterResource\RelationManagers;
use App\Models\RecyclingCenter;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions as FilamentExcelActions;

class RecyclingCenterResource extends Resource
{
    protected static ?string $model = RecyclingCenter::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $label = 'Pusat Daur Ulang';
    protected static ?string $pluralLabel = 'Pusat Daur Ulang';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('address')->required(),
                TextInput::make('contact')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('address')->sortable()->searchable(),
                TextColumn::make('contact')->sortable()->searchable(),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions([
                FilamentExcelActions\Tables\ExportAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRecyclingCenters::route('/'),
            'create' => Pages\CreateRecyclingCenter::route('/create'),
            'edit' => Pages\EditRecyclingCenter::route('/{record}/edit'),
        ];
    }
}
