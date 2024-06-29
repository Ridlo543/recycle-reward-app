<?php

namespace Database\Seeders;

use App\Models\WasteType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WasteTypeSeeder extends Seeder
{
    public function run()
    {
        $wasteTypes = [
            ['name' => 'Plastik', 'price_per_gram' => 0.05],
            ['name' => 'Botol', 'price_per_gram' => 0.10],
            ['name' => 'Kertas', 'price_per_gram' => 0.03],
        ];

        foreach ($wasteTypes as $wasteType) {
            WasteType::firstOrCreate(['name' => $wasteType['name']], $wasteType);
        }
    }
}
