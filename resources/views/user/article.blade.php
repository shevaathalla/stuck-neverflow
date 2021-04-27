@extends('layouts.base')
@section('title')
    <title>SN - Article List</title>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="float-md-left">
                <h2>Show All Article Made by {{ $user->name }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            @if (Auth::id() == $user->id)
                <div class="float-md-right">
                    <a href="{{ route('article.create') }}" class="btn btn-success"> <i class="fas fa-plus"></i>
                        Create</a>
                </div>
            @endif
        </div>
    </div>
    <hr>
    <div class="card shadow">
        <div class="card-header text-primary font-weight-bold">
            Article List
        </div>
        <div class="card-body">
            <table class="table table-bordered table-responsive-md" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Thumbnail</td>
                        <td>Title</td>
                        <td>Text</td>
                        <td>Posted at</td>
                        <td>Last updated at</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td><img class="img-thumbnail" src="{{ asset('storage/images/thumbnail/300/'.$article->picture) }}" alt="" width="100px" height="auto"></td>
                        <td> <a class="font-weight-bold" href="{{ route('article.show',['article'=>$article]) }}">  {{ $article->title }}</a></td>
                        <td>{!! Str::words($article->content, 15, $end=' ...')   !!}</td>
                        <td>{{ $article->created_at }}</td>
                        <td>{{ $article->updated_at }}</td>
                        <td>
                            <form action="{{ route('article.destroy',['article' =>$article]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="row">
                                    <div class="col">
                                        <a href="{{ route('article.edit',['article'=> $article]) }}" class="btn btn-block btn-warning my-2">Edit  <i class="fas fa-edit ml-2"></i></a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="btn btn-block btn-danger" onclick="return confirm('are you sure want to delete this article?')">Delete<i class="fas fa-trash ml-2"></i></button>
                                    </div>    
                                </div>                                                                
                            </form>
                        </td>
                    </tr>                        
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
@endpush