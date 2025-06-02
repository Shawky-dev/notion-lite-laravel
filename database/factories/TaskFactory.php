<?php

namespace Database\Factories;

use App\Models\Section;
use App\Models\User;
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
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'section_id' => Section::factory(), // Create a related Section if not provided
            'user_id' => User::factory(), // Create a related User if not provided
            'status' => $this->faker->randomElement(['pending', 'in-progress', 'completed']),
            'archive' => $this->faker->boolean(),
        ];
    }
}
