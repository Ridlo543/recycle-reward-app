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
use Illuminate\Support\Facades\DB;

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
                        ->weight('bold')
                        ->size(TextColumn\TextColumnSize::Large)
                        ->searchable(),
                    TextColumn::make('description')
                        ->label('Deskripsi')
                        ->sortable()
                        ->color('gray')
                        ->searchable()
                        ->limit(130),
                    TextColumn::make('code')
                        ->label('Kode Redeem')
                        ->sortable()
                        ->searchable()
                        ->copyable()
                        ->copyMessage('Kode Redeem telah disalin')
                        ->icon('heroicon-o-clipboard'),
                    TextColumn::make('partner.name')
                        ->label('Mitra')
                        ->sortable()
                        ->icon('heroicon-o-building-storefront')
                        ->weight('bold')
                        ->searchable(),
                    TextColumn::make('points_required')
                        ->label('Poin Diperlukan')
                        ->badge()
                        ->color('primary')
                        ->size(TextColumn\TextColumnSize::Large)
                        ->icon('heroicon-o-currency-dollar')
                        ->sortable(),
                    TextColumn::make('expires_at')
                        ->label('Kadaluarsa')
                        ->color('danger')
                        ->icon('heroicon-o-calendar')
                        ->sortable(),
                ])->space(2)
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

                        $hasRedeemed = DB::table('history_reward_users')
                            ->where('user_id', $user->id)
                            ->where('reward_id', $record->id)
                            ->exists();

                        if ($hasRedeemed) {
                            Notification::make()
                                ->title('Reward sudah ditukarkan')
                                ->body('Anda sudah menukarkan reward ini.')
                                ->danger()
                                ->send();
                            return;
                        }

                        DB::transaction(function () use ($user, $record) {
                            DB::table('users')
                                ->where('id', $user->id)
                                ->decrement('points', $record->points_required);

                            DB::table('history_reward_users')->insert([
                                'user_id' => $user->id,
                                'reward_id' => $record->id,
                                'redeemed_at' => now(),
                            ]);
                        });

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
                Tables\Actions\ViewAction::make()
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                ImageEntry::make('image')
                    ->simpleLightbox(),
                TextEntry::make('code')
                    ->label('Kode Redeem')
                    ->copyable()
                    ->copyMessage('Kode Redeem telah disalin')
                    ->icon('heroicon-o-clipboard')
                    ->weight(FontWeight::Bold),
                TextEntry::make('name')
                    ->label('Nama')
                    ->weight(FontWeight::Bold),
                TextEntry::make('description')
                    ->label('Deskripsi'),
                TextEntry::make('partner.name')
                    ->icon('heroicon-o-building-storefront')
                    ->label('Mitra'),
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
