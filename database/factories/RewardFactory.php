<?php

namespace Database\Factories;

use App\Models\Partner;
use App\Models\Reward;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RewardFactory extends Factory
{
    protected $model = Reward::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'image' => 'images/reward.jpg',
            'code' => strtoupper($this->faker->unique()->lexify('????????')),
            'points_required' => $this->faker->numberBetween(100, 1000),
            'expires_at' => $this->faker->dateTimeBetween('now', '+1 year'),
            'partner_id' => Partner::factory()->create()->id, // Ensure each reward has a partner
        ];
    }
}
