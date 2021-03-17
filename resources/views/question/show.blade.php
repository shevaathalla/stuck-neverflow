@extends('layouts.base')
@section('title')
    <title>Details Questione</title>
@endsection
@section('js')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection
@section('content')
    <h2>Details Questione #{{ $question->id }}</h2>
    <hr>
    <div class="card">
        <div class="card-header">
            Made by: {{ $question->user->name }} on {{ $question->created_at }}
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $question->title }}</h5>
            <p class="card-text">{!! $question->text !!}</p>
            <a href="{{ route('answer.create', ['question' => $question]) }}" class="btn btn-success float-md-left"> <i
                    class="fas fa-reply"> Answer</i></a>
            @auth
                @if (Auth::user()->id == $question->user_id)
                    <a href="{{ route('question.edit', ['question' => $question]) }}" class="btn btn-info float-md-right"><i
                            class="fa fa-edit"> Edit</i></a>                   
                    <a href="{{ route('question.destroy', ['question' => $question]) }}"
                        class="btn btn-danger float-md-right mr-lg-2" data-toggle="modal" data-target="#deleteModal">
                        <i class="fa fa-trash-alt">&nbsp; Delete</i>
                    </a>
                @endif
            @endauth
        </div>
    </div>
    <hr>
    <h4>Answer Count : {{ count($answers) }}</h4>
    @foreach ($answers as $answer)
        @include('components.answer',['answer' => $answer,'question' =>$question])
    @endforeach
    <!-- Delete Modal-->
    @include('components.modal',[
    'title_message' => 'Are you sure?',
    'message' => "Press red delete button to delete this question",
    'data_target_id' => 'deleteModal',
    'form_id' => 'delete-form',
    'route' => 'question.destroy',
    'params' => ['question' => $question],
    'button_text' => 'Delete',
    'method' => 'Delete'])
@endsection
