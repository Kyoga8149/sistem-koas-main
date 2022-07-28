<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HospitalFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => 'Hospital ' . $this->faker->word(),
        ];
    }
}
