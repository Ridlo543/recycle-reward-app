<?php

namespace App\Filament\RecycleCenter\Resources;

use App\Enums\WasteExchangeStatus;
use App\Filament\RecycleCenter\Resources\ExchangeWasteRecycleCenterResource\Pages;
use App\Filament\RecycleCenter\Resources\ExchangeWasteRecycleCenterResource\RelationManagers;
use App\Models\ExchangeWasteRecycleCenter;
use App\Models\WasteExchange;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ExchangeWasteRecycleCenterResource extends Resource
{
    protected static ?string $model = WasteExchange::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getLabel(): string
    {
        return 'Pertukaran Sampah';
    }

    public static function getPluralLabel(): string
    {
        return 'Pertukaran Sampah';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->disabled()
                    ->required(),
                Select::make('recycling_center_id')
                    ->relationship('recyclingCenter', 'name')
                    ->required(),
                Select::make('waste_type_id')
                    ->relationship('wasteType', 'name')
                    ->required(),
                TextInput::make('weight')
                    ->numeric()
                    ->required(),
                TextInput::make('points')
                    ->numeric()
                    ->disabled(),
                FileUpload::make('image')
                    ->label('Image')
                    ->image()
                    ->directory('images')
                    ->required(),
                TextInput::make('latitude')
                    ->numeric()
                    ->required(),
                TextInput::make('longitude')
                    ->numeric()
                    ->required(),
                Forms\Components\ToggleButtons::make('status')
                    ->inline()
                    ->options(WasteExchangeStatus::class)
                    ->required(),
                Placeholder::make('go_to_location')
                    ->content(fn ($record) => view('components.go-to-location-button', [
                        'latitude' => $record->latitude,
                        'longitude' => $record->longitude,
                    ])),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('User')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('recyclingCenter.name')
                    ->label('Recycling Center')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('wasteType.name')
                    ->label('Waste Type')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('weight')
                    ->label('Weight')
                    ->sortable(),
                TextColumn::make('points')
                    ->label('Points')
                    ->sortable(),
                ImageColumn::make('image')
                    ->label('Image')
                    ->simpleLightbox(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->label('Open')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    // list untu view
    public static function infolist(Infolist $infolist): Infolist
    {

        return $infolist
            ->schema([
                TextEntry::make('user.name'),
                TextEntry::make('recyclingCenter.name'),
                TextEntry::make('wasteType.name'),
                TextEntry::make('weight'),
                TextEntry::make('points'),
                ImageEntry::make('image')->disk('public')->simpleLightbox(),
                TextEntry::make('latitude'),
                TextEntry::make('longitude'),
                TextEntry::make('status'),
            ]);
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('recycling_center_id', auth()->id());
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExchangeWasteRecycleCenters::route('/'),
            'edit' => Pages\EditExchangeWasteRecycleCenter::route('/{record}/edit'),
            // 'view' => Pages\ViewExchangeWasteRecycleCenter::route('/{record}'),
        ];
    }
}
