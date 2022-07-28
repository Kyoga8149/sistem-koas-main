<?php

namespace Database\Factories;

use App\Enums\StudyType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(3),
            'description' => $this->faker->sentence(),
            'study_type' => StudyType::Clerkship,
        ];
    }
}
