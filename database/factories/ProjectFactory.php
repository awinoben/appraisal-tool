<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use World\Countries\Model\Country;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'country_id' => Country::query()->firstWhere('slug', 'kenya')->id,
            'user_id' => User::query()
                ->firstWhere('role_id', Role::query()
                    ->firstWhere('slug', 'group-coordinator')->id),
            'name' => $this->faker->company,
            'description' => $this->faker->realText(300)
        ];
    }
}
