<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WasteExchangeResource\Pages;
use App\Filament\Resources\WasteExchangeResource\RelationManagers;
use App\Models\WasteExchange;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WasteExchangeResource extends Resource
{
    protected static ?string $model = WasteExchange::class;
    protected static ?string $navigationIcon = 'heroicon-m-arrows-right-left';

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
                    ->required(),
                Select::make('recycling_center_id')
                    ->relationship('recyclingCenter', 'name')
                    ->required(),
                Select::make('waste_type_id')
                    ->relationship('wasteType', 'name')
                    ->required(),
                TextInput::make('weight')
                    ->required()
                    ->numeric()
                    ->reactive()
                    ->afterStateUpdated(fn (callable $set, $state, $get) => $set('points', $state * $get('wasteType.price_per_gram'))),
                TextInput::make('points')
                    ->disabled()
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('user.name')->sortable()->searchable()->label('User'),
                TextColumn::make('recyclingCenter.name')->sortable()->searchable()->label('Pusat Daur Ulang'),
                TextColumn::make('wasteType.name')->sortable()->searchable()->label('Jenis Sampah'),
                TextColumn::make('weight')->sortable()->searchable()->label('Berat (gram)'),
                TextColumn::make('points')->sortable()->searchable()->label('Poin'),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWasteExchanges::route('/'),
            'create' => Pages\CreateWasteExchange::route('/create'),
            'edit' => Pages\EditWasteExchange::route('/{record}/edit'),
        ];
    }
}
