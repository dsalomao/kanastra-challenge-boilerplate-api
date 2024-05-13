<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Data>
 */
class DataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'governmentId' => Str::random(10),
            'email' => fake()->unique()->safeEmail(),
            'debtAmount' => fake()->randomNumber(),
            'debtDueDate' => fake()->date(),
            'debtId' => fake()->unique()->randomNumber()
        ];
    }
}
