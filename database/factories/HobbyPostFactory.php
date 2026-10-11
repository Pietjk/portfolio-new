<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HobbyPost>
 */
class HobbyPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hobby_id' => \App\Models\Hobby::factory(),
            'name' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'image_path' => null,
            'link' => null,
        ];
    }
}
