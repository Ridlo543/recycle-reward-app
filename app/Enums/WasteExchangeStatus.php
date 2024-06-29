<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum WasteExchangeStatus: string implements HasColor, HasIcon, HasLabel
{
    case Processing = 'processing';
    case Picked = 'picked';
    case Accepted = 'accepted';
    case Cancelled = 'cancelled';

    public function getColor(): ?string
    {
        return match($this) {
            self::Processing => 'warning',
            self::Picked => 'primary',
            self::Accepted => 'success',
            self::Cancelled => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match($this) {
            self::Processing => 'heroicon-m-arrow-path',
            self::Picked => 'heroicon-m-truck',
            self::Accepted => 'heroicon-m-check-circle',
            self::Cancelled => 'heroicon-m-x-circle',
        };
    }

    public function getLabel(): ?string
    {
        return match($this) {
            self::Processing => 'Processing',
            self::Picked => 'Picked',
            self::Accepted => 'Accepted',
            self::Cancelled => 'Cancelled',
        };
    }

    // to array
    public function toArray(): array
    {
        return [
            self::Processing => self::Processing,
            self::Picked => self::Picked,
            self::Accepted => self::Accepted,
            self::Cancelled => self::Cancelled,
        ];
    }
}