<?php

namespace Database\Factories;

use App\Models\QuantityHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<QuantityHistory>
 */
class QuantityHistoryFactory extends Factory
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
            'quantity' => $this->faker->numberBetween(1, 100),
            'created_at' => $this->faker->dateTimeBetween('-90 days', '+3 days'),
        ];
    }
}
