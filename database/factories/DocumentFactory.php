<?php

namespace Database\Factories;

use App\Models\Document;
use App\Models\Lead;
use App\Models\Contact;
use App\Models\Deal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $relatedModels = [
            Lead::class,
            Contact::class,
            Deal::class,
        ];

        $relatedType = $this->faker->randomElement($relatedModels);
        $relatedId = $relatedType::inRandomOrder()->first()->id ?? null;

        return [
            'file_name' => $this->faker->word() . '.' . $this->faker->fileExtension(),
            'file_path' => 'public/documents/' . $this->faker->uuid() . '.' . $this->faker->fileExtension(), // dummy path
            'related_type' => $relatedId ? $relatedType : null,
            'related_id' => $relatedId,
            'uploaded_by' => User::factory(),
            'version' => $this->faker->numberBetween(1, 3),
        ];
    }
}
