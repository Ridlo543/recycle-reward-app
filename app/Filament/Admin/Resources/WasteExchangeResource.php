<?php

namespace App\Filament\Admin\Resources;

use App\Enums\WasteExchangeStatus;
use App\Filament\Admin\Resources\WasteExchangeResource\Pages;
use App\Filament\Admin\Resources\WasteExchangeResource\RelationManagers;
use App\Models\WasteExchange;
use App\Models\WasteType;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions as FilamentExcelActions;

class WasteExchangeResource extends Resource
{
    protected static ?string $model = WasteExchange::class;
    protected static ?string $navigationIcon = 'heroicon-m-arrows-right-left';
    protected static ?string $navigationGroup = 'User Management';

    
    protected static ?string $label = 'Pertukaran Sampah';
    protected static ?string $pluralLabel = 'Pertukaran Sampah';

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
                    ->label('Jenis Sampah')
                    ->options(WasteType::all()->pluck('name', 'id')->toArray())
                    ->required(),
                TextInput::make('weight')
                    ->required()
                    ->numeric()
                    ->reactive()
                    ->afterStateUpdated(function (callable $set, $state, $get) {
                        $wasteType = WasteType::find($get('waste_type_id'));
                        if ($wasteType) {
                            $set('points', $state * $wasteType->price_per_gram);
                        }
                    }),
                TextInput::make('points')
                    ->disabled()
                    ->numeric()
                    ->required(),
                FileUpload::make('image')
                    ->label('Gambar')
                    ->image(),
                TextInput::make('latitude')
                    ->label('Latitude')
                    ->required(),
                TextInput::make('longitude')
                    ->label('Longitude')
                    ->required(),
                Forms\Components\ToggleButtons::make('status')
                    ->inline()
                    ->options(WasteExchangeStatus::class)
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
                ImageColumn::make('image')
                    ->label('Image')
                    ->simpleLightbox(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge(),
                TextColumn::make('latitude')->sortable()->label('Latitude'),
                TextColumn::make('longitude')->sortable()->label('Longitude'),
                TextColumn::make('created_at')->dateTime()->sortable()->label('Dibuat Pada'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
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
