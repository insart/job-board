<?php

namespace Database\Seeders;

use App\Models\Employer;
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

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
