<?php

namespace Database\Factories;

use App\Models\Contribution;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContributionFactory extends Factory
{
    protected $model = Contribution::class;

    public function definition()
    {
        return [
            'amount' => $this->faker->numberBetween(100, 10000),
            'payment_method' => $this->faker->randomElement(['cash','card','bank transfer']),
            'payment_status' => $this->faker->randomElement(['pending','completed','failed']),
            'description' => $this->faker->sentence(),
            'added_by' => null,
        ];
    }
}
