<?php

namespace Database\Seeders;

use App\Models\User;
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
    {   DB::table('users')->insert([
        'name' => 'Sheva Athalla',
        'email' => 'shevaathalla@gmail.com',
        'password' => bcrypt('sheva1209'),
        'role_id' => '2',
    ]);
        User::factory()->times(10)->create();
    }
}
