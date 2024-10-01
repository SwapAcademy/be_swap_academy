<?php

namespace Database\Factories;

use App\Enum\Transaction\TypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'users_id' => 1,
            'transaction_type' => $this->faker->randomElement(TypeEnum::getValues()),
            'credits_amount' => $this->faker->numberBetween(1, 100),
            'date' => $this->faker->date(),
        ];
    }
}
