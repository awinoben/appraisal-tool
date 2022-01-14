<?php

namespace Database\Factories;

use App\Models\AssignedProject;
use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssignedProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AssignedProject::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'project_id' => Project::query()->first()->id,
            'user_id' => User::query()
                ->firstWhere('role_id', Role::query()
                    ->firstWhere('slug', 'bpo-executive')->id)->id,
        ];
    }
}
