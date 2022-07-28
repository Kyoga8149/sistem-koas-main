<?php

namespace Database\Factories;

use App\Enums\StudyType;
use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Group>
 */
class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->sentence(),
            'study_type' => StudyType::Clerkship,
            'school_id' => School::factory(),
            'start_date' => now(),
            'end_date' => now()->addYears(2),
        ];
    }
}
