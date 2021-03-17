<div class="card mb-2">
    <div class="card-body {{ $answer->approve == 1 ? 'bg-success text-gray-100' : ' ' }}">
        <h5 class="card-title{{ $answer->approve == 1 ? 'bg-success text-white' : ' ' }}">Answer Made by {{ $answer->user->name }} {{ $answer->approve == 1 ? '(APPROVED By Question Maker)' : ' ' }}</h5>
        <h6 class="card-subtitle mb-2">On {{ $answer->created_at }}</h6>
        <p class="card-text">{!! $answer->text !!}</p>
        <div class="row justify-content-between">
            <div class="ml-3">
                <a href="#" class="card-link{{ $answer->approve == 1 ? 'text-white' : ' ' }}">Comment</a>
            </div>
            <div class="form-group form-inline">                              
                    @auth
                        @if (Auth::user()->id == $question->user->id)
                        @if ( $answer->approve != 1)
                        <form action="{{ route('answer.approve',['question' => $question, 'answer' => $answer]) }}" method="POST">
                            @csrf  
                            <button type="submit" class="btn btn-success mr-2"> <i class="fas fa-thumbs-up"> Approve</i></button>
                        </form>
                        @else
                        <form action="{{ route('answer.unapprove',['question' => $question, 'answer' => $answer]) }}" method="POST">
                            @csrf
                            @method('PUT')  
                            <button type="submit" class="btn btn-warning text-dark mr-2"><i class="fas fa-thumbs-down"> Unapprove</i></button>
                        </form>
                        @endif                                          
                        @endif 
                                       
                    @endauth                
                <form action="{{ route('answer.destroy',['question' => $question, 'answer' => $answer]) }}" method="post">
                  @csrf
                  @method('Delete')
                  @auth
                        @if (Auth::user()->id == $answer->user->id)
                            <a href="{{ route('answer.edit',['question' => $question,'answer' => $answer]) }}" class="btn btn-secondary"> <i class="fas fa-edit"> Edit</i></a>
                            <button type="submit" class="btn btn-danger"  onclick="return confirm('are you sure want to delete this answer')"> <i class="fas fa-trash-alt"> Delete</i> </button>
                        @endif                
                    @endauth
                </form>
            </div>            
        </div>        
    </div>
</div>   
