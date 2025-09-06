<?php

namespace Database\Factories;

use App\Models\JobApplication;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<JobApplication>
 */
class JobApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'expected_salary' => fake()->numberBetween(10000, 150000),
            'resume' => fake()->url(),
            'cover_letter' => fake()->paragraphs(5, true),
            'status' => fake()->randomElement(['pending', 'accepted', 'rejected']),
        ];
    }
}
