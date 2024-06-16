<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WasteType>
 */
class WasteTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['Plastik', 'Botol', 'Kertas']),
            'price_per_gram' => $this->faker->randomFloat(2, 0.01, 0.1),
        ];
    }
}
