<?php

namespace Database\Seeders;

use App\Models\Badge;
use App\Models\Challenge;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChallengeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $badges = Badge::pluck('id');

        foreach ($badges as $badge) {
            Challenge::factory(5)->create([
                'badge_id' => $badge,
            ]);
        }
    }
}
