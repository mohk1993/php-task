<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'ean' => $this->faker->ean8(),
            'weight' => $this->faker->randomFloat(2, 1, 4),
            'color' => $this->faker->colorName(),
            'active' => $this->faker->boolean(),
            'image' => $this->faker->imageUrl(640, 480, 'sports', true, true)
        ];
    }
}
