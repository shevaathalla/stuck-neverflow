@extends('layouts.base')
@section('title')
    <title>SN - Questions</title>
@endsection
@section('content')
    <h2 class="text-gray-700">
        All Question
    </h2>
    <hr>
    <div class="col-md-12">
        @foreach ($questions as $question)
        <div class="card shadow mb-2">
            <div class="card-header">
                #{{ $question->id }}
            </div>
            <div class="card-body">
              <h5 class="card-title">{{ $question->title }}</h5>
              <h6 class="card-subtitle mb-2 text-muted">Made by: {{ $question->user->name }} on {{ $question->created_at }}</h6>
              <p class="card-text">{!! $question->text !!}</p>
              <a href="{{ route('question.show',['question' => $question]) }}" class="card-link">Show Detail</a>              
            </div>
          </div>
        @endforeach        
    </div>    
@endsection