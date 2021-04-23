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
                                <a href="" class="btn btn-success">Create Comment <i class="fas fa-plus ml-2"></i></a>    
                            </div>                   
                            @endauth                                     
                        </div>                                                                        
                    </div>                    
                    <hr>
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}" alt="">
                                </div>
                                <div class="col-md-9">
                                    <div class="card-title">
                                        <div class="text-gray-700 font-weight-bold">
                                            Name 
                                        </div>
                                        now
                                    </div>                                    
                                    <div class="card-text">
                                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit libero doloremque corrupti, quae consequatur tenetur repellat mollitia consectetur, odit culpa exercitationem vel harum dolorem! Temporibus tenetur animi quasi rerum natus?
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>        
            </div>
            <div class="col-md-3"id="sticky-sidebar">                
                <div class="sticky-top">
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
    </div>

@endsection
