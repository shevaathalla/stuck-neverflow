<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Notification;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{

    public function __construct()
    {
        $this->middleware('answer.maker')->only([
            'edit', 'update', 'destroy'
        ]);
    }

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
        $answer = Answer::create([
            'text' => $request->text,
            'question_id' =>$question->id,
            'user_id' => Auth::id(),
        ]);

        //make notification to question maker
        Notification::create([
            'user_id' => $question->user->id,
            'message' => 'Your question has been answered by '.$answer->user->name,
            'type' => 'question',
            'question_id' => $question->id
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

        //make notification to answer maker
        Notification::create([
            'user_id' => $answer->user->id,
            'message' => 'Your answer has been approved',
            'type' => 'answer',
            'answer_id' => $answer->id,
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
