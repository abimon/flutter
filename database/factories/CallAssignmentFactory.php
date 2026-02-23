<?php

namespace Database\Factories;

use App\Models\CallAssignment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CallAssignmentFactory extends Factory
{
    protected $model = CallAssignment::class;

    public function definition()
    {
        return [
            'caller_phone' => $this->faker->phoneNumber,
            'contact_name' => $this->faker->name,
            'contact_phone' => $this->faker->phoneNumber,
        ];
    }
}
