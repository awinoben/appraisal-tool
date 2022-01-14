<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use World\Countries\Model\Country;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create one user under this role
        User::query()->create([
            'branch_id' => Branch::query()->inRandomOrder()->first()->id,
            'country_id' => Country::query()->firstWhere('slug', 'kenya')->id,
            'role_id' => Role::query()->firstWhere('slug', 'human-resource')->id,
            'name' => 'Human Resource',
            'email' => 'hr@test.com',
            'employee_number' => Str::random(10),
            'email_verified_at' => now(),
            'password' => bcrypt('secret'), // password
            'remember_token' => Str::random(10),
        ]);
    }
}
