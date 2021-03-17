<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except([
            'index','show'
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::orderBy('name','asc')->get();
        return view('tag.index',compact('tags'));
    }
    public function show(Tag $tag)
    {
        return view('tag.show',compact('tag'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tag = Tag::firstOrCreate([
            'name' => $request->name,
        ]);
        if ($tag->wasRecentlyCreated) {
            return redirect(route('tag.index'))->with('toast_success',"Tag Berhasil dibuat");
        }else{
            return redirect(route('tag.index'))->with('toast_info',"Tag $tag->name sudah ada");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        // dd($tag);
        Tag::destroy($tag->id);
        return redirect(route('tag.index'))->with('toast_success',"Tag Berhasil dihapus");
    }
}
