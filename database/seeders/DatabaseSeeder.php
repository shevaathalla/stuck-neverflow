<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\QuestionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            QuestionSeeder::class,
            AnswerSeeder::class,
            TagSeeder::class,
            QuestionTagSeeder::class,                       
        ]);
    }
}
