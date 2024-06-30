<?php

namespace App\Filament\User\Resources;

use App\Enums\WasteExchangeStatus;
use App\Filament\User\Resources\ExchangeWasteUserResource\Pages;
use App\Filament\User\Resources\ExchangeWasteUserResource\RelationManagers;
use App\Models\ExchangeWasteUser;
use App\Models\WasteExchange;
use App\Models\WasteType;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ExchangeWasteUserResource extends Resource
{
    protected static ?string $model = WasteExchange::class;
    protected static ?string $navigationIcon = 'heroicon-m-arrows-right-left';
    
    protected static ?string $label = 'Tukar Sampah';
    protected static ?string $pluralLabel = 'Tukar Sampah';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->default(fn () => Auth::id())
                    ->disabled(),
                Select::make('recycling_center_id')
                    ->relationship('recyclingCenter', 'name')
                    ->required()
                    ->reactive(),
                    Select::make('waste_type_id')
                    ->options(WasteType::all()->pluck('name', 'id')->toArray())
                    ->required()
                    ->reactive(),
                TextInput::make('weight')
                    ->required()
                    ->numeric()
                    ->reactive()
                    ->disabled(fn ($get) => !$get('waste_type_id') || !$get('recycling_center_id'))
                    ->afterStateUpdated(function ($set, $state, $get) {
                        $wasteType = \App\Models\WasteType::find($get('waste_type_id'));
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
                    ->image()
                    ->directory('images')
                    ->required(),
                TextInput::make('latitude')
                    ->label('Latitude')
                    ->required(),
                TextInput::make('longitude')
                    ->label('Longitude')
                    ->required(),
                Placeholder::make('getLocationButton')
                    ->content(view('components.get-location-button')),
                Select::make('status')
                    ->options([
                        WasteExchangeStatus::Processing->value => 'Processing',
                        WasteExchangeStatus::Cancelled->value => 'Cancelled',
                    ])
                    ->default(WasteExchangeStatus::Processing->value)
                    ->required(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\CreateExchangeWasteUser::route('/'),
        ];
    }
}
