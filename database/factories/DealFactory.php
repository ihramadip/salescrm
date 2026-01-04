<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Deal>
 */
class DealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $stage = $this->faker->randomElement(['qualification', 'proposal', 'negotiation', 'won', 'lost']);
        $createdAt = $this->faker->dateTimeBetween('-1 year', 'now');

        return [
            'title' => $this->faker->catchPhrase(),
            'company_id' => Company::factory(),
            'contact_id' => Contact::factory(),
            'assigned_to' => User::factory(),
            'value' => $this->faker->randomFloat(2, 500, 250000),
            'stage' => $stage,
            'probability' => $this->getProbabilityForStage($stage),
            'expected_close_date' => $this->faker->dateTimeBetween($createdAt, '+3 months')->format('Y-m-d'),
            'created_at' => $createdAt,
            'updated_at' => $this->faker->dateTimeBetween($createdAt, 'now'),
        ];
    }

    /**
     * Get a realistic probability based on the deal stage.
     *
     * @param string $stage
     * @return int
     */
    private function getProbabilityForStage(string $stage): int
    {
        return match ($stage) {
            'qualification' => 10,
            'proposal' => 50,
            'negotiation' => 75,
            'won' => 100,
            'lost' => 0,
            default => 5,
        };
    }
}