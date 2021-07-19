<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'lars admin',
            'role' => 'admin',
            'email' => 'contact@larslommen.com',
            'password' => Hash::make('enE6gdsEFW%US@h9'),
        ]);

        DB::table('users')->insert([
            'name' => 'lars user',
            'email' => 'lj.lommen@gmail.com',
            'password' => Hash::make('$#Di2MZi@C*UHC^X'),
        ]);
    }
}
