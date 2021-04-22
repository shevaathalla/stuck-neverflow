@extends('layouts.base')
@section('title')
    <title>SN - Tag Question</title>
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
    @foreach ($tag->questions as $question)
        <div class="card shadow mb-2">
            <div class="card-header">
                #{{ $question->id }}
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $question->title }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">Made by: {{ $question->user->name }} on
                    {{ $question->created_at }}</h6>
                <p class="card-text">{!! $question->text !!}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('question.show', ['question' => $question]) }}" class="card-link">Show Detail</a>
            </div>
        </div>
    @endforeach
@endsection
