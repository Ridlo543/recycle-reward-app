<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\WasteExchangeRankingResource\Pages;
use App\Filament\User\Resources\WasteExchangeRankingResource\RelationManagers;
use App\Models\User;
use App\Models\WasteExchange;
use App\Models\WasteExchangeRanking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class WasteExchangeRankingResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';
    protected static ?string $label = 'Waste Exchange Ranking';
    protected static ?string $pluralLabel = 'Waste Exchange Rankings';

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('User Name'),
                TextColumn::make('points')
                    ->label('Points')
                    ->sortable()
                    ->badge(),
            ])
            ->defaultSort('points', 'desc')
            ->filters([])
            ->actions([])
            ->bulkActions([]);
    }

    public static function getEloquentQuery(): Builder
    {
        return User::query()
            ->orderByDesc('points');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWasteExchangeRankings::route('/'),
        ];
    }
}

                // ->getStateUsing(function ($record) {
                //     return static::hashName($record->name);
                // }),