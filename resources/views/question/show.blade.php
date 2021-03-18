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
            <div class="row">
                <div class="col">
                    <h3 class="text-lg"> Made by: {{ $question->user->name }} on {{ $question->created_at }}</h3>
                </div>
                <div class="col">
                    <a href="{{ route('answer.create', ['question' => $question]) }}"
                        class="btn btn-success float-md-right">
                        <i class="fas fa-reply">
                            Answer
                        </i>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <h3 class="card-title">{{ $question->title }}</h5>
                <p class="card-text">{!! $question->text !!}</p>
                @foreach ($question->tags as $tag)
                    <a href="{{ route('tag.show', ['tag' => $tag]) }}"
                        class="btn btn-primary my-1">{{ $tag->name }}</a>
                @endforeach
        </div>
        <div class="card-footer">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group form-inline">
                            <button class="btn btn-primary w-75" type="button" data-toggle="collapse"
                                data-target="#collapseComment" aria-expanded="false" aria-controls="collapseComment">
                                Show Comments
                            </button>
                            <a href="{{ route('commentQuestion.create', ['question' => $question]) }}"
                                class="btn btn-success w-auto ml-3">Add Comment</a>
                        </div>
                        <div class="collapse" id="collapseComment">
                            <div class="card card-body">
                                @foreach ($question->comments as $comment)
                                    <div class="row">
                                        <div class="col-sm-10">

                                            <p style="padding: 0px; margin: 0px">{{ $comment->text }} - <a
                                                    href="">{{ $comment->user->name }}</a></p>
                                            <p style="padding: 0px; margin: 0px" class="text-gray-500">
                                                {{ $comment->created_at }}</p>
                                            <hr style="padding: 0px; margin: 0px">
                                        </div>
                                        <div class="col">
                                            @if (Auth::id() == $comment->user_id)
                                                <form action="{{ route('comment.destroy', ['comment' => $comment]) }}"
                                                    method="post">
                                                    <button type="submit" class="btn btn-danger"> <i
                                                            class="fas fa-trash"></i> Delete</button>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        @auth
                            @if (Auth::user()->id == $question->user_id)
                                <a href="{{ route('question.edit', ['question' => $question]) }}"
                                    class="btn btn-info float-md-right"><i class="fa fa-edit"> Edit</i></a>
                                <a href="{{ route('question.destroy', ['question' => $question]) }}"
                                    class="btn btn-danger float-md-right mr-lg-2" data-toggle="modal"
                                    data-target="#deleteModal">
                                    <i class="fa fa-trash-alt">&nbsp; Delete</i>
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
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
