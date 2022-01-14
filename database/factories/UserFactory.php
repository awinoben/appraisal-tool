<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use World\Countries\Model\Country;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'branch_id' => Branch::query()->inRandomOrder()->first()->id,
            'country_id' => Country::query()->firstWhere('slug', 'kenya')->id,
            'role_id' => Role::query()->firstWhere('slug', 'super-admin')->id,
            'name' => 'Java House Limited',
            'email' => 'admin@javahouseafrica.com',
            'employee_number' => Str::random(10),
            'email_verified_at' => now(),
            'password' => bcrypt('secret'), // password
            'remember_token' => Str::random(10),
        ];
    }
}
