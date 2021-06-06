<div class="card mb-2">
    <div class="card-body {{ $answer->approve == 1 ? 'bg-success text-gray-100' : ' ' }}">
        <h6 class="card-title {{ $answer->approve == 1 ? 'bg-success text-white' : 'text-gray-900' }}">Answer Made by
            <a href="{{ route('user.show',['user' => $answer->user]) }}" class="{{ $answer->approve == 1 ? 'text-dark' : '' }}">{{ $answer->user->name }}</a>
            {{ $answer->approve == 1 ? '(APPROVED By Question Maker)' : ' ' }}</h6>
        <h6 class="card-subtitle mb-2">On {{ $answer->created_at }}</h6>
        <h5 class="text-gray-900">{!! $answer->text !!}</h5>
    </div>
    <div class="card-footer">
        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group form-inline">
                        <button class="btn btn-primary w-75" type="button" data-toggle="collapse"
                            data-target="#collapseAnswer{{ $answer->id }}" aria-expanded="false"
                            aria-controls="collapseAnswer">
                            Show Comments ({{ $answer->comments->count() }})
                        </button>
                        <a href="{{ route('commentAnswer.create', ['answer' => $answer]) }}"
                            class="btn btn-success w-auto ml-3">Add Comment</a>
                    </div>
                    <div class="collapse" id="collapseAnswer{{ $answer->id }}">
                        <div class="card card-body">
                            @foreach ($answer->comments as $comment)
                                <div class="row">
                                    <div class="col-sm-9">
                                        <p style="padding: 0px; margin: 0px">{{ $comment->text }} - <a class="card-link"
                                                href="{{ route('user.show',['user' => $comment->user]) }}">{{ $comment->user->name }}</a></p>
                                        <p style="padding: 0px; margin: 0px" class="text-gray-500">
                                            {{ $comment->created_at }}</p>
                                        <hr style="padding: 0px; margin: 0px">
                                    </div>
                                    <div class="col">
                                        @if (Auth::id() == $comment->user_id)
                                            <a href="{{ route('comment.destroy', ['comment' => $comment]) }}"
                                                class="btn btn-danger" data-target="#deleteAnswerCommentModal{{ $comment->id }}" data-toggle="modal"> <i class="fas fa-trash"></i>
                                                Delete
                                            </a>
                                            <!-- Delete Answer Comment Modal-->
                                            <div class="modal fade" id="deleteAnswerCommentModal{{ $comment->id }}"
                                                tabindex="0" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                {{ __('Are you Sure want tu delete this Comment') }}</h5>
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
                                                                onclick="event.preventDefault(); document.getElementById('delete-answer-comment-form-{{ $comment->id }}').submit();">{{ __('Delete') }}</a>
                                                            <form id="delete-answer-comment-form-{{ $comment->id }}"
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
                        @if (Auth::user()->id == $question->user->id)
                            @if ($answer->approve != 1)
                                <form
                                    action="{{ route('answer.approve', ['question' => $question, 'answer' => $answer]) }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success ml-2 float-md-right"> <i
                                            class="fas fa-thumbs-up">
                                            Approve</i></button>
                                </form>
                            @else
                                <form
                                    action="{{ route('answer.unapprove', ['question' => $question, 'answer' => $answer]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-warning text-dark ml-2 float-md-right"><i
                                            class="fas fa-thumbs-down">
                                            Unapprove</i></button>
                                </form>
                            @endif
                        @endif

                    @endauth
                    @auth
                        @if (Auth::user()->id == $answer->user->id || Auth::user()->role->name == 'admin')
                            <a href="{{ route('answer.edit', ['question' => $question, 'answer' => $answer]) }}"
                                class="btn btn-secondary float-md-right ml-2"> <i class="fas fa-edit"> Edit</i></a>
                            <a href="{{ route('answer.destroy', ['answer' => $answer, 'question' => $question]) }}"
                                class="btn btn-danger float-md-right" data-toggle="modal"
                                data-target="#deleteAnswerModal{{ $answer->id }}"> <i class="fas fa-trash-alt">
                                    Delete</i>
                            </a>
                            <!-- Delete Modal-->
                            <div class="modal fade" id="deleteAnswerModal{{ $answer->id }}" tabindex="0" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ __('Are You sure wantu delete this Answer?') }}</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">{{ 'deleted data is irreversible' }}</div>
                                        <div class="modal-footer">
                                            <button class="btn btn-link" type="button"
                                                data-dismiss="modal">{{ __('Cancel') }}</button>
                                            <a class="btn btn-danger"
                                                href="{{ route('answer.destroy', ['question' => $question, 'answer' => $answer]) }}"
                                                onclick="event.preventDefault(); document.getElementById('delete-answer-form-{{ $answer->id }}').submit();">{{ __('Delete') }}</a>
                                            <form id="delete-answer-form-{{ $answer->id }}"
                                                action="{{ route('answer.destroy', ['question' => $question, 'answer' => $answer]) }}"
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
