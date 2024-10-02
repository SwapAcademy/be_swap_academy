<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MentoringFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mentoring_name' => $this->faker->sentence(3),
            'category' => $this->faker->randomElement(CategoryEnum::getValues()),
            'description' => $this->faker->paragraph(3),
        ];
    }
}
