@extends('layouts.base')
@section('title')
    <title>Details Questione</title>
@endsection
@section('js')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection
@section('content')
    <h2>Details Questione</h2>
    <hr>
    <div class="card">
        <div class="card-header">
            #{{ $question->id }}
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $question->title }}</h5>
            <p class="card-text">{!! $question->text !!}</p>
            <a href="{{ route('question.edit', ['question' => $question]) }}"
                class="btn btn-success float-md-left">Answer</a>
            @auth
                @if (Auth::user()->id == $question->user_id)
                    <a href="{{ route('question.edit', ['question' => $question]) }}"
                        class="btn btn-info float-md-right">Edit</a>
                    <form id="form-delete" action="{{ route('question.destroy', ['question' => $question]) }}" method="post">
                        @csrf
                        @method('Delete')
                        <input type="hidden" class="delete-id" value="{{ $question->id }}">
                        <input type="submit" value="Delete" onclick="return confirm('Yakin ingin menghapus pertanyaan ini?')" class="btn btn-danger float-md-right mr-lg-2">
                    </form>
                @endif
            @endauth
        </div>
    </div>
@endsection
