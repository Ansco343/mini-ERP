<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
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
            'trans_date' => $this->faker->dateTimeBetween('-1 Month', 'now'),
            'desc' => $this->faker->sentence(3),
            'amount' => $this->faker->numberBetween(1000,2000000),
            'category_id' => Category::inRandomOrder()->first()->id ?? 1
        ];
    }
}
