<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use World\Countries\Seeds\WorldCountriesTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(WorldCountriesTableSeeder::class);
        $this->call(BranchTableSeeder::class);
        $this->call(RoleTableSeeder::class);
//        $this->call(UserTableSeeder::class);
        $this->call(KRAndKPI::class);
        User::factory()->create();
//        $this->call(ProjectTableSeeder::class);
    }
}
