<?php

namespace Database\Seeders;

use App\Models\RecyclingCenter;
use App\Models\User;
use App\Models\WasteExchange;
use App\Models\WasteType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WasteExchangeSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $recyclingCenters = RecyclingCenter::all();
        $wasteTypes = WasteType::all();

        foreach ($users as $user) {
            foreach ($recyclingCenters as $center) {
                foreach ($wasteTypes as $wasteType) {
                    WasteExchange::factory()->create([
                        'user_id' => $user->id,
                        'recycling_center_id' => $center->id,
                        'waste_type_id' => $wasteType->id,
                    ]);
                }
            }
        }
    }
}
