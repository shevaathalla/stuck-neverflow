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
                    <h3 class="text-lg">Made by: <a href="{{ route('user.show',['user'=>$question->user]) }}"> {{ $question->user->name }} </a>on {{ $question->created_at }}</h3>
                </div>
                <div class="col">
                    <form action="{{ route('question.generatepdf',['question'=> $question]) }}" method="post" class="form-inline float-right">
                        @csrf
                        <button type="submit" class="btn btn-secondary mr-3" > Export <i class="fa fa-file-pdf ml-2"></i></button>
                        <a href="{{ route('answer.create', ['question' => $question]) }}"
                            class="btn btn-success float-md-right">
                            <i class="fas fa-reply">
                                Answer
                            </i>
                        </a>                    
                    </form>                                        
                </div>
            </div>
        </div>
        <div class="card-body">
            <h3 class="card-title text-primary">{{ $question->title }}</h5>
                <div class="card-text text-gray-900" style="font-size: 20px">{!! $question->text !!}</div>
                @foreach ($question->tags as $tag)
                    <a href="{{ route('tag.question', ['tag' => $tag]) }}"
                        class="btn btn-primary round my-1" style="font-size: 70%">{{ $tag->name }}</a>
                @endforeach
        </div>
        <div class="card-footer">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-9">                        
                        <div class="form-group form-inline">
                            <button class="btn btn-primary w-75 mr-3" type="button" data-toggle="collapse"
                                data-target="#collapseComment" aria-expanded="false" aria-controls="collapseComment">
                                Show Comments ({{ $question->comments->count() }})
                            </button>
                            <a href="{{ route('commentQuestion.create', ['question' => $question]) }}"
                                class="btn btn-success w-auto mt-auto">Add Comment</a>
                        </div>
                        <div class="collapse" id="collapseComment">
                            <div class="card card-body">
                                @foreach ($question->comments as $comment)
                                    <div class="row">
                                        <div class="col-sm-10">

                                            <p style="padding: 0px; margin: 0px">{{ $comment->text }} - <a class="card-link"
                                                    href="{{ route('user.show',['user' => $comment->user]) }}">{{ $comment->user->name }}</a></p>
                                            <p style="padding: 0px; margin: 0px" class="text-gray-500">
                                                {{ $comment->created_at }}</p>
                                            <hr style="padding: 0px; margin: 0px">
                                        </div>
                                        <div class="col">
                                            @if (Auth::id() == $comment->user_id || Auth::user()->role->name == 'admin' )
                                                <a href="{{ route('comment.destroy', ['comment' => $comment]) }}"
                                                    class="btn btn-danger"
                                                    data-target="#deleteQuestionCommentModal{{ $comment->id }}"
                                                    data-toggle="modal">
                                                    <i class="fas fa-trash"></i> Delete</a>
                                                <!-- Delete Question Comment Modal-->
                                                <div class="modal fade" id="deleteQuestionCommentModal{{ $comment->id }}"
                                                    tabindex="0" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    {{ __('Are you Sure want tu delete this Comment') }}
                                                                </h5>
                                                                <button class="close" type="button" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">{{ 'deleted data is irreversible' }}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-link" type="button"
                                                                    data-dismiss="modal">{{ __('Cancel') }}</button>
                                                                <a class="btn btn-danger"
                                                                    href="{{ route('comment.destroy', ['comment' => $comment]) }}"
                                                                    onclick="event.preventDefault(); document.getElementById('delete-question-comment-form-{{ $comment->id }}').submit();">{{ __('Delete') }}</a>
                                                                <form
                                                                    id="delete-question-comment-form-{{ $comment->id }}"
                                                                    action="{{ route('comment.destroy', ['comment' => $comment]) }}"
                                                                    method="POST" style="display: none;">
                                                                    @csrf
                                                                    @method('delete')
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        @auth
                            @if (Auth::id() == $question->user_id || Auth::user()->role->name == 'admin')
                                <a href="{{ route('question.edit', ['question' => $question]) }}"
                                    class="btn btn-info float-md-right"><i class="fa fa-edit"> Edit</i></a>
                                <a href="{{ route('question.destroy', ['question' => $question]) }}"
                                    class="btn btn-danger float-md-right mr-lg-2" data-toggle="modal"
                                    data-target="#deleteModal">
                                    <i class="fa fa-trash-alt">&nbsp; Delete</i>
                                </a>
                                <!-- Delete Modal-->
                                <div class="modal fade" id="deleteModal" tabindex="0" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">{{ __('Are you sure?') }}</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">{{ 'deleted data is irreversible' }}</div>
                                            <div class="modal-footer">
                                                <button class="btn btn-link" type="button"
                                                    data-dismiss="modal">{{ __('Cancel') }}</button>
                                                <a class="btn btn-danger"
                                                    href="{{ route('question.destroy', ['question' => $question]) }}"
                                                    onclick="event.preventDefault(); document.getElementById('delete-question-form').submit();">{{ __('Delete') }}</a>
                                                <form id="delete-question-form"
                                                    action="{{ route('question.destroy', ['question' => $question]) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
@endsection
