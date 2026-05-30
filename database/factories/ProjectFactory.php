<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        $start = fake()->dateTimeBetween('-2 months', 'now');
        $end = fake()->dateTimeBetween($start, '+3 months');

        return [
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'start_date' => $start->format('Y-m-d'),
            'end_date' => $end->format('Y-m-d'),
            'manager_id' => User::factory(),
        ];
    }
}
