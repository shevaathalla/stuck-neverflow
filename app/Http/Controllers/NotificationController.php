<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(User $user){
        return view('user.notifications');
    }

    public function show(User $user, Notification $notification){
        $notification = Notification::where('id',$notification->id)->first();
        $notification->update([
            'read_status' => 1
        ]);
        
        // dd($notification);
        if ($notification->type == 'question') {
            return redirect(route('question.show',['question'=>$notification->question]));
        }else if ($notification->type == 'answer') {
            return redirect(route('question.show',['question'=>$notification->answer->question]));
        }
    }
}
