<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enum\Course\StatusEnum;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EnrollmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'enrollment_at' => $this->faker->date(),
            'progress' => $this->faker->numberBetween(0, 100),
            'Status' => $this->faker->randomElement(StatusEnum::getValues()),
        ];
    }
}
