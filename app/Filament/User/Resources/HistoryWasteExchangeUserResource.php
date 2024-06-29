<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\HistoryWasteExchangeUserResource\Pages;
use App\Models\WasteExchange;
use App\Models\WasteExchangeUser;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HistoryWasteExchangeUserResource extends Resource
{
    protected static ?string $model = WasteExchange::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getLabel(): string
    {
        return 'History Pertukaran Sampah';
    }

    public static function getPluralLabel(): string
    {
        return 'History Pertukaran Sampah';
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('recyclingCenter.name'),
                Tables\Columns\TextColumn::make('wasteType.name'),
                Tables\Columns\TextColumn::make('weight'),
                Tables\Columns\TextColumn::make('points'),
                Tables\Columns\TextColumn::make('latitude'),
                Tables\Columns\TextColumn::make('longitude'),
                Tables\Columns\ImageColumn::make('image')->disk('public'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('user.name'),
                TextEntry::make('recyclingCenter.name'),
                TextEntry::make('wasteType.name'),
                TextEntry::make('weight'),
                TextEntry::make('points'),
                TextEntry::make('latitude'),
                TextEntry::make('longitude'),
                ImageEntry::make('image')->disk('public'),
                TextEntry::make('created_at')->dateTime(),
            ]);
    }


    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWasteExchangeUsers::route('/'),
            'view' => Pages\ViewWasteExchangeUser::route('/{record}'),
        ];
    }
}
