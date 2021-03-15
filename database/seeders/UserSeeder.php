<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
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
            'name' => 'Sheva',
            'email' => 'shevaathalla' . '@gmail.com',
            'password' => 'sheva1209',
        ]);
        for ($i = 0; $i < 10; $i++) {
            DB::table('users')->insert([
                'name' => Str::random(10),
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password'),
            ]);
        }
    }
}
