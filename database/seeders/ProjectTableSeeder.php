<?php

namespace Database\Seeders;

use App\Models\AssignedProject;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;
use World\Countries\Model\Country;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $project = Project::query()->create([
            'country_id' => Country::query()->firstWhere('slug', 'kenya')->id,
            'user_id' => User::query()->firstWhere('name', 'Branch Manager')->id,
            'name' => 'Department A',
            'is_closed' => false
        ]);

        foreach (User::query()->whereNotIn('name', ['Human Resource', 'System Admin'])->get() as $user) {
            AssignedProject::query()->updateOrCreate([
                'project_id' => $project->id,
                'user_id' => $user->id,
                'is_closed' => false
            ]);
        }
    }
}
