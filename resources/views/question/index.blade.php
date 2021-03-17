@extends('layouts.base')
@section('title')
    <title>SN - Questions</title>
@endsection
@section('content')
<div class="row justify-content-between">
    <div class="col">
        <h2 class="text-gray-700">
            All Question
        </h2>
    </div>   
    <div class="col">
        <a href="{{ route('question.create') }}" class="btn btn-success float-right mr-3"> <i class="fas fa-plus">  Create</i></a>
    </div>     
</div>    
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
              @foreach ($question->tags as $tag)
              <a href="{{ route('tag.show',['tag' =>$tag]) }}" class="btn btn-primary my-1">{{ $tag->name  }}</a>
              @endforeach                            
            </div>
            <div class="card-footer">
                <a href="{{ route('question.show',['question' => $question]) }}" class="card-link">Show Detail</a>              
            </div>
          </div>
        @endforeach        
    </div>    
@endsection