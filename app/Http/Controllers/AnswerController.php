<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Question $question)
    {
        return view('answer.create',compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Question $question)
    {
        Answer::create([
            'text' => $request->text,
            'question_id' =>$question->id,
            'user_id' => Auth::id(),
        ]);
        return redirect(route('question.show',['question'=>$question]))->with('toast_success','Jawaban berhasil diinput');
    }


    public function edit(Question $question, Answer $answer)
    {
        return view('answer.edit',compact('question','answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question, Answer $answer)
    {
        Answer::where('id',$answer->id)->update([
            'text' => $request->text,
        ]);
        return redirect(route('question.show',['question' => $question]))->with('toast_info','Jawaban berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Answer $answer)
    {
        Answer::destroy($answer->id);
        return redirect(route('question.show',['question' => $question]))->with('toast_success','Jawaban berhasil didelete');
    }

    public function approve(Question $question, Answer $answer)
    {
        Answer::where('id',$answer->id)->update([
            'approve' => true,
        ]);
        return redirect(route('question.show',['question' => $question]))->with('toast_success','Jawaban berhasil diapprove!!');
    }
    public function unapprove(Question $question, Answer $answer)
    {
        Answer::where('id',$answer->id)->update([
            'approve' => false,
        ]);
        return redirect(route('question.show',['question' => $question]))->with('toast_info','Jawaban diunapprove!!');
    }
}
