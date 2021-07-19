<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subcategories')->insert([
            'name' => 'Salaries',
            'category_id' => 1,
        ]);

        DB::table('subcategories')->insert([
            'name' => 'General',
            'category_id' => 1,
        ]);

        DB::table('subcategories')->insert([
            'name' => 'Overheads',
            'category_id' => 1,
        ]);

        DB::table('subcategories')->insert([
            'name' => 'Fees',
            'category_id' => 1,
        ]);

        DB::table('subcategories')->insert([
            'name' => 'Salaries',
            'category_id' => 2,
        ]);

        DB::table('subcategories')->insert([
            'name' => 'General',
            'category_id' => 2,
        ]);

        DB::table('subcategories')->insert([
            'name' => 'Overheads',
            'category_id' => 2,
        ]);

        DB::table('subcategories')->insert([
            'name' => 'Fees',
            'category_id' => 2,
        ]);

        DB::table('subcategories')->insert([
            'name' => 'Salaries',
            'category_id' => 3,
        ]);

        DB::table('subcategories')->insert([
            'name' => 'General',
            'category_id' => 3,
        ]);

        DB::table('subcategories')->insert([
            'name' => 'Overheads',
            'category_id' => 3,
        ]);

        DB::table('subcategories')->insert([
            'name' => 'Fees',
            'category_id' => 3,
        ]);

        DB::table('subcategories')->insert([
            'name' => 'Salaries',
            'category_id' => 4,
        ]);

        DB::table('subcategories')->insert([
            'name' => 'General',
            'category_id' => 4,
        ]);

        DB::table('subcategories')->insert([
            'name' => 'Overheads',
            'category_id' => 4,
        ]);

        DB::table('subcategories')->insert([
            'name' => 'Fees',
            'category_id' => 4,
        ]);
    }
}
