<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SpendFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'value' => fake()->randomFloat(2, 1, 1500),
            'date' => fake()->date(),
        ];
    }
}
