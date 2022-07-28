<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => 'School ' . $this->faker->word(),
        ];
    }
}
