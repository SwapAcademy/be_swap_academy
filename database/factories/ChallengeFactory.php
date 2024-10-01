<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ChallengeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'challenge_name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(3),
            'reward_credits' => $this->faker->numberBetween(100, 1000),
        ];
    }
}
