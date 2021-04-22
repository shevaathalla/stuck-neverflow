<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('created_at','DESC')->paginate(5);
        return view('article.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::orderBy('name', 'asc')->get();        
        return view('article.create',compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article = Article::create([
            'title' => $request->title,
            'content' => $request->text,
            'user_id' => Auth::id(),            
        ]);
        $tags = $request->tag;
        if (!empty($tags)) {
            foreach ($tags as $tagName) {
                $tag = Tag::firstOrCreate([
                    'name' => $tagName,
                ]);
                if ($tag) {
                    $tagNames[] = $tag->id;
                }
            }
            $article->tags()->syncWithoutDetaching($tagNames);
        }
        if($request->file('thumbnail')){
            $file= $request->file('thumbnail');
            $filename = $request->thumbnail->getClientOriginalName();
            Image::make($file)->resize(300, 300)->save( public_path('storage/images/thumbnail/300/' . $filename ) );
            Image::make($file)->resize(1920, 1080)->save( public_path('storage/images/thumbnail/landscape/' . $filename ) );
            
            $article->update(['picture'=>$filename]);
        }        
        
        return redirect(route('user.article',['user'=>Auth::user()]))->with('toast_success','Article berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }

    public function userArticle(User $user){
        $articles = Article::where('user_id',$user->id)->paginate(5);
        return view('user.article',compact(['articles','user']));
    }
}
