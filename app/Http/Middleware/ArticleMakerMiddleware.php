<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleMakerMiddleware
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
        $article = $request->route()->parameter('article');        
        if (Auth::id() == $article->user_id) {
            return $next($request);   
        }else{
            return abort(401);
        }        
    }
}
