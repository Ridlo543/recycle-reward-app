<?php

namespace Database\Factories;

use App\Models\WasteType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WasteType>
 */
class WasteTypeFactory extends Factory
{
    protected $model = WasteType::class;

    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['Plastik', 'Botol', 'Kertas']),
            'price_per_gram' => $this->faker->randomFloat(2, 0.01, 0.1),
        ];
    }
}
