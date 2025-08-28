<?php

namespace Database\Factories;

use App\Models\JobVacancy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<JobVacancy>
 */
class JobVacancyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle(),
            'description' => fake()->paragraphs(5, true),
            'salary' => fake()->numberBetween(10000, 100000),
            'location' => fake()->city(),
            'status' => fake()->randomElement(JobVacancy::$statuses),
            'level' => fake()->randomElement(JobVacancy::$levels),
            'category' => fake()->randomElement(JobVacancy::$categories),
        ];
    }
}
