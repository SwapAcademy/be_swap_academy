<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::pluck('id');
        $course = Course::pluck('id');

        foreach ($user as $userId) {
            foreach ($course as $courseId) {
                Enrollment::factory()->create([
                    'users_id' => $userId,
                    'course_id' => $courseId,
                ]);
            }
        }
    }
}
