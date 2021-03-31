<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        'email_verified_at' => now(),
        'created_at' => now(),        
        'role_id' => '1',
    ]);
    DB::table('users')->insert([
        'name' => 'admin',
        'email' => 'admin@mail.com',
        'password' => bcrypt('admin'),
        'email_verified_at' => now(),
        'created_at' => now(),       
        'role_id' => '2',
    ]);
    
        User::factory()->times(10)->create();
    }
}
