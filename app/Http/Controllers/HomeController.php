<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tags =  Tag::all();
        return view('home',compact('tags'));
    }

    public function searchTag(Request $request){
        // dd($request);
        $tag = Tag::find($request->tag);        
        if ($tag) {
            return redirect(route('tag.question',['tag'=>$tag]))->with('toast_success','Tag berhasil ditemukan');   
        }else{
            return redirect()->back()->with('error','Tag tidak berhasil ditemukan');
        }
    }
}
