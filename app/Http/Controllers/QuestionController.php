<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth','verified'])->except([
            'index', 'show'
        ]);
        $this->middleware('question.maker')->only([
            'edit', 'update', 'destroy'
        ]);
    }
    public function index()
    {
        $questions = Question::orderBy('id', 'DESC')->paginate(10);
        // dd($questions);  
        return view('question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::orderBy('name', 'asc')->get();
        return view('question.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);        
        $question = Question::create([
            'title' => $request->title,
            'text' => $request->text,
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
            $question->tags()->syncWithoutDetaching($tagNames);
        }
        return redirect(route('question.index'))->with('toast_success', 'Pertanyaan berhasil diinput');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {        
        $answers = Answer::where('question_id', $question->id)
            ->orderBy('created_at', 'DESC')
            ->get();        
        return view('question.show', compact('question', 'answers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view('question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        Question::where('id', $question->id)->update([
            'title' => $request->title,
            'text' => $request->text,
        ]);
        return redirect(route('question.show', ['question' => $question]))->with('toast_info', 'Pertanyaan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        Question::destroy($question->id);
        return redirect(route('question.index'))->with('toast_success', 'Pertanyaan berhasil didelete');
    }
}
