<?php

namespace Database\Factories;

use App\Enum\User\BadgeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BadgeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'badge_name' => $this->faker->randomElement(BadgeEnum::getValues()),
            'description' => $this->faker->text,
            'required_action' => $this->faker->numberBetween(1, 100),
        ];
    }
}
