<?php

namespace Database\Seeders;

use App\Models\Badge;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::pluck('id');

        foreach ($user as $userId) {
            Badge::factory()
                ->count(3)
                ->create([
                    'users_id' => $userId,
                ]);
        }
    }
}
