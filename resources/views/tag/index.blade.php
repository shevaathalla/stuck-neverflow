@extends('layouts.base')
@section('title')
    <title>SN - Tag List</title>
@endsection
@section('content')
<h2>Display Tag List</h2>
<hr>
<form action="{{ route('tag.store') }}" method="POST">
    @csrf
<div class="row mb-2">    
    <div class="col-md-9">
        <input name="name" id="name" type="text" class="form-control" 
        placeholder="Click here to name your new tag then press the button on the right to add your new Tag"
        autofocus="true" autocomplete="tag">
    </div>
    <div class="col-md-3">        
            <button type="submit" class="btn btn-success float-right"> <i class="fas fa-tags"> Create Tag</i></button>        
    </div>
</form>
</div>
<table class="table table-border">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>        
        <th scope="col">Action</th>        
      </tr>
    </thead>
    <tbody>
        @foreach ($tags as $tag)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td class="text-gray-800 text-lg">{{ $tag->name }}</td>
            <td>              
       <form action="{{ route('tag.destroy',['tag'=>$tag]) }}" method="post" style="inline">
        @csrf
        @method('delete')
        <a href="{{ route('tag.show',['tag'=>$tag]) }}" class="btn btn-info"> <i class="fas fa-question-circle"></i>  Question</a>
        <button type="submit" class="btn btn-danger" onclick="return confirm('are you sure want to delete this tag?')"> <i class="fas fa-trash-alt"></i> Delete</button>
        </form>
            </td>        
          </tr>      
        @endforeach      
    </tbody>
  </table> 
@endsection