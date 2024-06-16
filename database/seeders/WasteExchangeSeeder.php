<?php

namespace Database\Seeders;

use App\Models\WasteExchange;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WasteExchangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        WasteExchange::factory()
            ->count(20)
            ->create();
    }
}
