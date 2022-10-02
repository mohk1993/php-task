<?php

namespace Database\Factories;

use App\Models\PriceHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PriceHistory>
 */
class PriceHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => $this->faker->numberBetween(1, 10),
            'price' => $this->faker->randomFloat(2, 1, 4),
            'created_at' => $this->faker->dateTimeBetween('-90 days', '+3 days'),
        ];
    }
}
