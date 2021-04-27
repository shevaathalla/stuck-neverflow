@extends('layouts.base')
@section('title')
    <title>Article Details</title>
@endsection
@section('content')
    <div class="container-fluid">
        @foreach ($article->tags as $tag)
            <a href="{{ route('tag.article', ['tag' => $tag]) }}"
                class="btn btn-primary round my-1">{{ $tag->name }}</a>
        @endforeach
        <div class="row">
            <div class="col-md-9">
                <img class="img-fluid my-3" src="{{ asset('storage/images/thumbnail/landscape/' . $article->picture) }}"
                    alt="Gambar Artikel">
                <small>
                    <i class="fas fa-user mr-1"></i> By : <a href="{{ route('user.show', ['user' => $article->user]) }}">
                        {{ $article->user->name }}</a>
                    <i class="fas fa-clock ml-4 mr-1"></i>{{ $article->created_at }}
                </small>
                <h2 class="text-gray-900 font-weight-bold my-3">{{ $article->title }}</h2>
                <div class="text-gray-600">{!! $article->content !!}</div>
                <div class="my-4">
                    <div class="row">
                        <div class="col">
                            <h2>Comments <i class="fas fa-comment ml-3"></i></h2>
                        </div>
                        <div class="col">
                            @auth
                            <div class="float-right">
                                <a href="{{ route('commentArticle.create',['article' => $article]) }}" class="btn btn-success">Create Comment <i class="fas fa-plus ml-2"></i></a>    
                            </div>                   
                            @endauth                                     
                        </div>                                                                        
                    </div>                    
                    <hr>
                    @foreach ($article->comments as $comment)
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <img class="img-profile rounded-circle" src="{{ asset('storage/images/avatar/'.$comment->user->avatar) }}" alt="avatar" width="100px" height="100px">
                                </div>
                                <div class="col-md-10">
                                    <div class="card-title">
                                        <div class="text-gray-700 font-weight-bold">
                                            {{ $comment->user->name }} 
                                        </div>
                                        {{ $comment->created_at }}
                                    </div>                                    
                                    <div class="card-text">
                                        {{ $comment->text }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                   
                    @endforeach                     
                </div>        
            </div>
            <div class="col-md-3"id="sticky-sidebar">                                
                    <h4 class="mt-2 ml-2 border-bottom-primary font-weight-bold">New Article <i
                        class="fa fa-fire text-primary"></i></h4>
                @foreach ($articles as $a)
                    <div class="card p-2">
                        <div class="row">
                            <div class="col">
                                <img class="img-fluid" src="{{ asset('storage/images/thumbnail/300/' . $a->picture) }}"
                                    alt="">
                            </div>
                            <div class="col my-auto mx-auto">
                                <a href="{{ route('article.show', ['article' => $a]) }}"
                                    class="card-link font-weight-bolder">{{ $a->title }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach                
            </div>
        </div>        
    </div>

@endsection
