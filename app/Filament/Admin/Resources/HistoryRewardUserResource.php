<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\HistoryRewardUserResource\Pages;
use App\Filament\Admin\Resources\HistoryRewardUserResource\RelationManagers;
use App\Models\HistoryRewardUser;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use pxlrbt\FilamentExcel\Actions as FilamentExcelActions;

class HistoryRewardUserResource extends Resource
{
    protected static ?string $model = HistoryRewardUser::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'User Management';

    
    protected static ?string $label = 'History Reward User';
    protected static ?string $pluralLabel = 'History Reward User';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('user_id')
                    ->disabled()
                    ->required(),
                TextInput::make('reward_id')
                    ->disabled()
                    ->required(),
                DateTimePicker::make('redeemed_at')
                    ->label('Redeemed At')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('user_id')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user_name')
                    ->label('User')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('reward_id')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('reward_name')
                    ->label('Reward')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('redeemed_at')
                    ->label('Redeemed At')
                    ->searchable()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
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

    public static function getEloquentQuery(): Builder
    {
        return HistoryRewardUser::query()
            ->select('history_reward_users.*', 'users.name as user_name', 'rewards.name as reward_name')
            ->leftJoin('users', 'history_reward_users.user_id', '=', 'users.id')
            ->leftJoin('rewards', 'history_reward_users.reward_id', '=', 'rewards.id');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHistoryRewardUsers::route('/'),
            'create' => Pages\CreateHistoryRewardUser::route('/create'),
            'view' => Pages\ViewHistoryRewardUser::route('/{record}'),
            'edit' => Pages\EditHistoryRewardUser::route('/{record}/edit'),
        ];
    }
}
