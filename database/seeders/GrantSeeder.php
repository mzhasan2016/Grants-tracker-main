<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grant;

class GrantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Grant::factory()
            ->count(30)
            ->create();
    }
}
