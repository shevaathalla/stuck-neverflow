@extends('layouts.base')
@section('title')
    <title>SN - Tag Article</title>
@endsection
@section('content')
    <h2>{{ $tag->name }} Tag</h2>
    <hr>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ Route::is('tag.question') ? 'active' : '' }}" href="{{ route('tag.question',['tag' => $tag]) }}">Question</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('tag.article') ? 'active' : '' }}" href="{{ route('tag.article',['tag' => $tag]) }}">Article</a>
        </li>
    </ul>
    @foreach ($tag->articles as $article)
    <div class="card my-2">        
        <div class="card-body">            
            <div class="row">
                <div class="col-md-3">
                    <img  class="img-thumbnail" src="{{ asset('storage/images/thumbnail/300/'.$article->picture) }}" alt="">
                </div>
                <div class="col-md-9">
                    <div class="card-title">
                        <div class="text-gray-900">
                            <h5 class="font-weight-bold">{{ $article->title }}</h5>
                        </div>                
                    </div>
                    <div class="card-subtitle">
                        Created at : {{ $article->created_at }}
                    </div>
                    <hr>
                    <div class="card-text">
                        <div class="text-gray-800">
                            {!! Str::words($article->content, 100, $end=' ...') !!}
                        </div>                        
                    </div>
                </div>
            </div>            
        </div>
        <div class="card-footer">
            <div class="float-md-left">
                Creator : <a href="{{ route('user.show',['user'=> $article->user]) }}">{{ $article->user->name }}</a>
            </div>
            <div class="float-md-right">
                <div class="card-link">
                    <a href="{{ route('article.show',['article'=>$article]) }}">Show More</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection
