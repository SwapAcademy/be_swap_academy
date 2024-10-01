<?php

namespace Database\Factories;

use App\Enum\Skill\TypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'skill_name' => $this->faker->sentence(3),
            'category' => $this->faker->randomElement(TypeEnum::getValues()),
        ];
    }
}
