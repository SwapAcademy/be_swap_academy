<?php

namespace Database\Seeders;

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
        $this->call([
            UserSeeder::class,
            BadgeSeeder::class,
            SkillSeeder::class,
            CourseSeeder::class,
            EnrollmentSeeder::class,
            TransactionSeeder::class,
            CourseSeeder::class,
            ChallengeSeeder::class,
            VideoSeeder::class,
        ]);
    }
}
