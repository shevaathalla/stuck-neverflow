<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Comment;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function commentQuestionStore(Request $request, Question $question){
        Comment::create([
            'text' => $request->text,
            'question_id' => $question->id,
            'user_id' => Auth::id() ? Auth::id() : 'anonymous',
        ]);
        return redirect(route('question.show',['question'=>$question]))->with('toast_success','Comment berhasil ditambahkan');
    }

    public function commentAnswerStore(Request $request,Question $question, Answer $answer){
        Comment::create([
            'text' => $request->text,
            'answer_id' => $answer->id,
            'user_id' => Auth::id() ? Auth::id() : 'anonymous',
        ]);
        return redirect(route('question.show',['question'=>$answer->question]))->with('toast_success','Comment berhasil ditambahkan');
    }

    public function commentQuestionCreate(Question $question){
        return view('comment.commentQuestionCreate',compact('question'));
    }
    public function commentAnswerCreate(Answer $answer){
        return view('comment.commentAnswerCreate',compact('answer'));
    }
    public function destroy(Comment $comment){
        Comment::destroy($comment->id);
        return back()->with('toast_success','Comment berhasil dihapus');
    }
}
