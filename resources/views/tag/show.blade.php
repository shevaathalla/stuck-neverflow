@extends('layouts.base')
@section('title')
    <title>SN - Tag Info</title>
@endsection
@section('content')
    <h2>Questions for {{ $tag->name }} Tag</h2>
    <hr>
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
