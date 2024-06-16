<?php

namespace Database\Seeders;

use App\Models\RecyclingCenter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecyclingCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        RecyclingCenter::factory()
            ->count(5)
            ->create();
    }
}
