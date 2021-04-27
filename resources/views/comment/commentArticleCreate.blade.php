@extends('layouts.base')
@section('title')
    <title>SN - Create Article Comment</title>
@endsection
@section('content')
<h2 class="text-gray-700">
    Make Comment Article
</h2>
<hr class="">
    <div class="col-md-12">
        <form 
        action="{{ route('commentArticle.store',['article'=>$article])}}" method="post">
            @csrf                     
            <label for="content" class="col-form-label text-gray-700" >Type your Comment below</label>
            <textarea name="text" id="text" cols="30" rows="10" class="form-control" required></textarea>
            <div class="my-4">
                <button type="submit" class="btn btn-primary mr-auto"> Submit <i class="fas fa-arrow-alt-circle-right ml-2"></i></button>
            </div>            

        </form>
    </div>    
@endsection
