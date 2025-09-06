<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\JobApplication;
use App\Models\JobVacancy;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Insanus Sunasni',
            'email' => 'test@example.com',
        ]);

        User::factory(3000)->create();

        $users = User::all()->random(200);
        for ($i = 1; $i <= 200; $i++) {
            Employer::factory()->create([
                'user_id' => $users->pop()->id,
            ]);
        }

        $employers = Employer::all();
        for ($i = 1; $i <= 500; $i++) {
            JobVacancy::factory()->create([
                'employer_id' => $employers->random()->id,
            ]);
        }

        $applicants = User::all()
            ->whereNotIn('id', $users->pluck('id'))
            ->random(100);

        foreach ($applicants as $applicant) {
            $vacancies = JobVacancy::inRandomOrder()->take(rand(1, 5))->get();

            foreach ($vacancies as $vacancy) {
                JobApplication::factory()->create([
                    'user_id' => $applicant->id,
                    'job_vacancy_id' => $vacancy->id,
                ]);
            }
        }
    }
}
