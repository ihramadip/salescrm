<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'company_id' => Company::factory(),
            'assigned_to' => User::factory(),
            'created_by' => User::factory(),
            'status' => $this->faker->randomElement(['new', 'contacted', 'qualified', 'unqualified']),
            'source' => $this->faker->randomElement(['web', 'referral', 'partner', 'other']),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => fn (array $attributes) => $this->faker->dateTimeBetween($attributes['created_at'], 'now'),
        ];
    }
}