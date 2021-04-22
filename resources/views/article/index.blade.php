@extends('layouts.base')
@section('title')
    <title>SN - Article List</title>
@endsection
@section('content')
    <h2>Show All Article</h2>
    <hr>
    @foreach ($articles as $article)
    <div class="card my-2">        
        <div class="card-body">            
            <div class="row">
                <div class="col-md-3">
                    <img src="{{ asset('storage/images/thumbnail/300/'.$article->picture) }}" alt="" width="100%" height="100%">
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
                    <a href="">Show More</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach        
        {{ $articles->links() }}    
@endsection