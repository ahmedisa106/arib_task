<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Manager;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'manager_id' => Manager::query()->inRandomOrder()->first()->id,
            'employee_id' => Employee::query()->inRandomOrder()->first()->id,
            'name' => $this->faker->name(),
            'status' => random_int(0, 1)
        ];
    }
}
