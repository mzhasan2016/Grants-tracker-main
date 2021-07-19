<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Food Bank',
        ]);

        DB::table('categories')->insert([
            'name' => 'CAP',
        ]);

        DB::table('categories')->insert([
            'name' => 'Building',
        ]);

        DB::table('categories')->insert([
            'name' => 'Fundraising',
        ]);
    }
}
