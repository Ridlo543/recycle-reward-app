<?php

namespace Database\Factories;

use App\Models\RecyclingCenter;
use App\Models\User;
use App\Models\WasteType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WasteExchange>
 */
class WasteExchangeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $wasteType = WasteType::inRandomOrder()->first();
        $weight = $this->faker->numberBetween(100, 1000);

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'recycling_center_id' => RecyclingCenter::inRandomOrder()->first()->id,
            'waste_type_id' => $wasteType->id,
            'weight' => $weight,
            'points' => $weight * $wasteType->price_per_gram,
        ];
    }
}
