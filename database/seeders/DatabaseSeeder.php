<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User', 'password' => bcrypt('password')]
        );

        $manager = User::firstOrCreate(
            ['email' => 'manager@example.com'],
            ['name' => 'Project Manager', 'password' => bcrypt('password')]
        );

        $employees = User::whereNotIn('email', ['test@example.com', 'manager@example.com'])->limit(5)->get();
        if ($employees->count() < 5) {
            $employees = User::factory(5 - $employees->count())->create();
        }

        Project::factory(4)
            ->for($manager, 'manager')
            ->create()
            ->each(function (Project $project) use ($employees) {
                Task::factory(rand(2, 5))
                    ->for($project, 'project')
                    ->state(function () use ($employees) {
                        return ['assigned_to' => $employees->random()->id];
                    })
                    ->create();
            });
    }
}
