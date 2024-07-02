<?php

namespace App\Filament\Admin\Resources\HistoryRewardUserResource\Pages;

use App\Filament\Admin\Resources\HistoryRewardUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Database\Eloquent\Builder;

class ViewHistoryRewardUser extends ViewRecord
{
    protected static string $resource = HistoryRewardUserResource::class;

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()
            ->select('history_reward_users.*', 'users.name as user_name', 'rewards.name as reward_name')
            ->leftJoin('users', 'history_reward_users.user_id', '=', 'users.id')
            ->leftJoin('rewards', 'history_reward_users.reward_id', '=', 'rewards.id');
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
