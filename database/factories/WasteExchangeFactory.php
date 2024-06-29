<?php

namespace Database\Factories;

use App\Models\RecyclingCenter;
use App\Models\User;
use App\Models\WasteExchange;
use App\Models\WasteType;
use Illuminate\Database\Eloquent\Factories\Factory;

class WasteExchangeFactory extends Factory
{
    protected $model = WasteExchange::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'recycling_center_id' => RecyclingCenter::factory(),
            'waste_type_id' => WasteType::factory(),
            'weight' => $this->faker->randomFloat(2, 1, 100),
            'points' => $this->faker->randomFloat(2, 1, 100),
            'image' => 'images/waste.jpg',
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'status' => $this->faker->randomElement(['processing', 'picked', 'accepted']),
        ];
    }
}
