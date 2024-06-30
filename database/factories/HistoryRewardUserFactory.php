<?php

namespace Database\Factories;

use App\Models\HistoryRewardUser;
use App\Models\Reward;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistoryRewardUserFactory extends Factory
{
    protected $model = HistoryRewardUser::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'reward_id' => Reward::factory(),
            'redeemed_at' => now(),
        ];
    }
}
