<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\RedeemRewardUserResource\Pages;
use App\Filament\User\Resources\RedeemRewardUserResource\RelationManagers;
use App\Models\RedeemRewardUser;
use App\Models\Reward;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;

class RedeemRewardUserResource extends Resource
{
    protected static ?string $model = Reward::class;
    protected static ?string $navigationIcon = 'heroicon-o-gift';

    protected static ?string $label = 'Reward';
    protected static ?string $pluralLabel = 'Rewards';

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->columns([
                Stack::make([
                    ImageColumn::make('image')
                        ->label('Gambar')
                        ->height('100%')
                        ->width('100%')
                        ->size(100)
                        ->simpleLightbox()
                        ->alignment(Alignment::Center),
                    TextColumn::make('name')
                        ->label('Nama')
                        ->sortable()
                        ->weight(FontWeight::Bold)
                        ->searchable(),
                    TextColumn::make('description')
                        ->label('Deskripsi')
                        ->sortable()
                        ->color('gray')
                        ->searchable()
                        ->limit(130),
                    TextColumn::make('points_required')
                        ->badge()
                        ->color('primary')
                        ->icon('heroicon-o-currency-dollar')
                        ->label('Poin Diperlukan')
                        ->extraAttributes(['class' => 'my-2'])
                        ->sortable(),
                    TextColumn::make('expires_at')
                        ->label('Kadaluarsa')
                        ->color('danger')
                        ->icon('heroicon-o-calendar')
                        ->sortable(),
                ])
            ])
            ->filters([])
            ->actions([
                Action::make('redeem')
                    ->label('Tukar')
                    ->action(function ($record) {
                        $user = Auth::user();

                        if ($user->points < $record->points_required) {
                            Notification::make()
                                ->title('Poin tidak mencukupi')
                                ->body('Anda tidak memiliki cukup poin untuk menukarkan reward ini.')
                                ->danger()
                                ->send();
                            return;
                        }

                        if ($user->historyRewardUsers()->where('reward_id', $record->id)->exists()) {
                            Notification::make()
                                ->title('Reward sudah ditukarkan')
                                ->body('Anda sudah menukarkan reward ini.')
                                ->danger()
                                ->send();
                            return;
                        }

                        $user->points -= $record->points_required;
                        $user->save();

                        $user->historyRewardUsers()->create([
                            'reward_id' => $record->id,
                            'redeemed_at' => now(),
                        ]);

                        Notification::make()
                            ->title('Berhasil Menukarkan Reward')
                            ->body('Anda berhasil menukarkan reward ini.')
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Konfirmasi Penukaran Reward')
                    ->modalDescription('Apakah Anda yakin ingin menukarkan reward ini?')
                    ->modalSubmitActionLabel('Konfirmasi'),
                // view
                Tables\Actions\ViewAction::make()
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                ImageEntry::make('image')
                    ->simpleLightbox(),
                TextEntry::make('name')
                    ->label('Nama')
                    ->weight(FontWeight::Bold),
                TextEntry::make('description')
                    ->label('Deskripsi'),
                TextEntry::make('points_required')
                    ->label('Poin Diperlukan'),
                TextEntry::make('expires_at')
                    ->label('Tanggal Kadaluarsa'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRedeemRewardUsers::route('/'),
        ];
    }
}
