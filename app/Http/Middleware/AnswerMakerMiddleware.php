<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AnswerMakerMiddleware
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
        $answer = $request->route()->parameter('answer');        
        if (Auth::id() == $answer->user_id) {
            return $next($request);   
        }else{
            return abort(401);
        }        
    }
}
