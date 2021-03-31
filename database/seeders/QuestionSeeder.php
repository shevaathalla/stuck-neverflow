<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Question::factory()->times(10)->create();
    }
}
