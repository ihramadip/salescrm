<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SalesTarget>
 */
class SalesTargetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Or pick from existing users
            'month' => $this->faker->numberBetween(1, 12),
            'year' => $this->faker->numberBetween(date('Y'), date('Y') + 2),
            'target_amount' => $this->faker->randomFloat(2, 1000, 100000),
        ];
    }
}
