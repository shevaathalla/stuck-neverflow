<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ArticleTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articles = Article::paginate(10);
        $tags = Tag::paginate(10);

        foreach ($articles as $article) {
            foreach ($tags as $tag) {
                ArticleTag::firstOrCreate([
                    'article_id' => $article->id,
                    'tag_id' => $tag->id,
                ]);
            }
        }
    }
}
