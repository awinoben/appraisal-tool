<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branches = array(
            'FINANCE - KENYA',
            'AUDIT'
        );

        foreach ($branches as $branch) {
            Branch::query()->create([
                'name' => $branch
            ]);
        }
    }
}
