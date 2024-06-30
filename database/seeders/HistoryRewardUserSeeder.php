<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HistoryRewardUser;

class HistoryRewardUserSeeder extends Seeder
{
    public function run()
    {
        HistoryRewardUser::factory()->count(10)->create();
    }
}
