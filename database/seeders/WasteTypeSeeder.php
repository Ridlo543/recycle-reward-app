<?php

namespace Database\Seeders;

use App\Models\WasteType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WasteTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        WasteType::factory()
            ->count(3)
            ->create();
    }
}
