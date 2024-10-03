<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;


class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // public function run(): void
    // {
    //     $user = User::pluck('id');
    //     $course = Course::pluck('id');

    //     foreach ($user as $userId) {
    //         foreach ($course as $courseId) {
    //             Enrollment::factory()->create([
    //                 'users_id' => $userId,
    //                 'course_id' => $courseId,
    //             ]);
    //         }
    //     }
    // }

    public function run(): void
    {
        Course::factory()->count(10)->create();
    }
}
