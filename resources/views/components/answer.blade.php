<div class="card mb-2">
    <div class="card-body {{ $answer->approve == 1 ? 'bg-success text-gray-100' : ' ' }}">
        <h5 class="card-title{{ $answer->approve == 1 ? 'bg-success text-white' : ' ' }}">Answer Made by
            {{ $answer->user->name }} {{ $answer->approve == 1 ? '(APPROVED By Question Maker)' : ' ' }}</h5>
        <h6 class="card-subtitle mb-2">On {{ $answer->created_at }}</h6>
        <h5>{!! $answer->text !!}</h5>
    </div>
    <div class="card-footer">
        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group form-inline">
                        <button class="btn btn-primary w-75" type="button" data-toggle="collapse"
                            data-target="#collapseAnswer{{ $answer->id }}" aria-expanded="false"
                            aria-controls="collapseAnswer">
                            Show Comments
                        </button>
                        <a href="{{ route('commentAnswer.create', ['answer' => $answer]) }}"
                            class="btn btn-success w-auto ml-3">Add Comment</a>
                    </div>
                    <div class="collapse" id="collapseAnswer{{ $answer->id }}">
                        <div class="card card-body">
                            @foreach ($answer->comments as $comment)
                                <div class="row">
                                    <div class="col-sm-9">
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
                                        <button type="submit" class="btn btn-danger"> <i class="fas fa-trash"></i> Delete</button>
                                        @endif                                        
                                        </form>
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
                    <form action="{{ route('answer.destroy', ['question' => $question, 'answer' => $answer]) }}"
                        method="post">
                        @csrf
                        @method('Delete')
                        @auth
                            @if (Auth::user()->id == $answer->user->id)
                                <a href="{{ route('answer.edit', ['question' => $question, 'answer' => $answer]) }}"
                                    class="btn btn-secondary float-md-right ml-2"> <i class="fas fa-edit"> Edit</i></a>
                                <button type="submit" class="btn btn-danger float-md-right"
                                    onclick="return confirm('are you sure want to delete this answer')"> <i
                                        class="fas fa-trash-alt"> Delete</i> </button>
                            @endif
                        @endauth
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
