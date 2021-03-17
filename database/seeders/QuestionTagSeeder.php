<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Tag;
use App\Models\QuestionTag;
use Illuminate\Database\Seeder;

class QuestionTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = Question::paginate(10);
        $tags = Tag::paginate(10);

        foreach ($questions as $question) {
            foreach ($tags as $tag) {
                QuestionTag::firstOrCreate([
                    'question_id' => $question->id,
                    'tag_id' => $tag->id,
                ]);
            }
        }

    }
}
