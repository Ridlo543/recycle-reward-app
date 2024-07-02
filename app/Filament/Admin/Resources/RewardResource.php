<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RewardResource\Pages;
use App\Filament\Admin\Resources\RewardResource\RelationManagers;
use App\Models\Reward;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
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

class RewardResource extends Resource
{
    protected static ?string $model = Reward::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->label('Nama'),
                TextInput::make('description')
                    ->label('Deskripsi')
                    ->nullable(),
                Select::make('partner_id')
                    ->label('Mitra')
                    ->relationship('partner', 'name')
                    ->required()
                    ->preload(),
                FileUpload::make('image')
                    ->label('Gambar')
                    ->image()
                    ->directory('images')
                    ->default('images/reward.png'),
                TextInput::make('code')
                    ->required()
                    ->unique()
                    ->label('Kode Redeem'),
                TextInput::make('points_required')
                    ->required()
                    ->numeric()
                    ->label('Poin'),
                DatePicker::make('expires_at')
                    ->required()
                    ->label('Tenggat Tanggal'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Nama'),
                TextColumn::make('description')
                    ->limit(50)
                    ->label('Deskripsi'),
                TextColumn::make('partner.name')
                    ->label('Mitra')
                    ->searchable()
                    ->sortable(),
                ImageColumn::make('image')
                    ->label('Gambar')
                    ->simpleLightbox(),
                TextColumn::make('code')
                    ->label('Kode Redeem'),
                TextColumn::make('expires_at')
                    ->label('Tenggat Tanggal')
                    ->date(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRewards::route('/'),
            'create' => Pages\CreateReward::route('/create'),
            'view' => Pages\ViewReward::route('/{record}'),
            'edit' => Pages\EditReward::route('/{record}/edit'),
        ];
    }
}
