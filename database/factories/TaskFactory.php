<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    public function definition()
    {
        $statuses = ['create', 'await', 'processed', 'done'];

        return [
            'title' => $this->faker->name(),
            'status' => $statuses[rand(0, 3)],
            'created_by' => Str::uuid()->toString()
        ];
    }
}
