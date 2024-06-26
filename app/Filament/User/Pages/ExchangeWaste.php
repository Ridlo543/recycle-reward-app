<?php

namespace App\Filament\User\Pages;

use App\Models\WasteExchange;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;

class ExchangeWaste extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.user.pages.exchange-waste';

    public $user_id;
    public $recycling_center_id;
    public $waste_type_id;
    public $weight;
    public $points;

    protected function getFormSchema(): array
    {
        return [
            Select::make('recycling_center_id')
                ->label('Pusat Daur Ulang')
                ->options(\App\Models\RecyclingCenter::all()->pluck('name', 'id'))
                ->required(),
            Select::make('waste_type_id')
                ->label('Jenis Sampah')
                ->options(\App\Models\WasteType::all()->pluck('name', 'id'))
                ->required(),
            TextInput::make('weight')
                ->label('Berat (gram)')
                ->numeric()
                ->required()
                ->reactive()
                ->afterStateUpdated(fn (callable $set, $state, $get) => $set('points', $state * $get('wasteType.price_per_gram'))),
            TextInput::make('points')
                ->label('Poin')
                ->disabled()
                ->numeric()
                ->required(),
        ];
    }

    public function submit()
    {
        $this->validate([
            'recycling_center_id' => 'required',
            'waste_type_id' => 'required',
            'weight' => 'required|numeric',
        ]);

        WasteExchange::create([
            'user_id' => auth()->id(),
            'recycling_center_id' => $this->recycling_center_id,
            'waste_type_id' => $this->waste_type_id,
            'weight' => $this->weight,
            'points' => $this->points,
        ]);

        $this->reset();

        session()->flash('success', 'Sampah berhasil ditukar dan poin telah ditambahkan.');
    }
}
