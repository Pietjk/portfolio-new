<?php

namespace Database\Factories;

use App\Models\Employer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Experience>
 */
class ExperienceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employer_id' => Employer::factory(),
            'function' => fake()->jobTitle(),
            'description' => fake()->sentence(),
            'start_date' => fake()->dateTimeBetween('-5 years', '-1 year')->format('Y-m-d'),
            'end_date' => null,
        ];
    }
}
