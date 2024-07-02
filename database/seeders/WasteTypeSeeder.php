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
            ['name' => 'Plastik', 'price_per_gram' => 0.1],  // Plastik usually has a lower value per gram
            ['name' => 'Kertas', 'price_per_gram' => 0.05], // Paper also has a low value
            ['name' => 'Logam', 'price_per_gram' => 0.2],   // Metals are generally more valuable
            ['name' => 'Tekstil', 'price_per_gram' => 0.15], // Textiles can vary, but typically mid-range
            ['name' => 'Kaca', 'price_per_gram' => 0.05],   // Glass has a relatively low value
            ['name' => 'Elektronik', 'price_per_gram' => 0.3], // Electronics are often more valuable due to components
        ];

        foreach ($wasteTypes as $wasteType) {
            WasteType::firstOrCreate(['name' => $wasteType['name']], $wasteType);
        }
    }
}
