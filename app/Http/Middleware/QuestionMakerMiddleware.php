<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionMakerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $question = $request->route()->parameter('question');
        if (Auth::id() == $question->user_id || Auth::user()->role->name == 'admin') {
            return $next($request);   
        }else{
            return abort(401);
        }
    }
}
