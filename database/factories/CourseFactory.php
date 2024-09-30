<?php

namespace Database\Factories;

use App\Enum\Course\CategoryEnum;
use App\Enum\Course\DiffEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_name' => $this->faker->sentence(3),
            'category' => $this->faker->randomElement(CategoryEnum::getValues()),
            'description' => $this->faker->paragraph(3),
            'difficulty_level' => $this->faker->randomElement(DiffEnum::getValues()),
            'duration' => $this->faker->numberBetween(1, 12),
            'credits_required' => $this->faker->numberBetween(1, 3),
        ];
    }
}
