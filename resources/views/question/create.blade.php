@extends('layouts.base')
@section('title')
    <title>SN - Create</title>
@endsection
@section('js')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@endsection
@section('content')
<h2 class="text-gray-700">
    Create Question
</h2>
<hr class="">
    <div class="col-md-12">
        <form action="{{ route('question.store') }}" method="post">
            @csrf
            <label for="title" class="col-form-label text-gray-700">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
            <label for="content" class="col-form-label text-gray-700" >Text</label>
            <textarea name="text" id="text" cols="30" rows="10"></textarea>
            <div class="my-4">
                <button type="submit" class="btn btn-primary mr-auto"> Submit <i class="fas fa-arrow-alt-circle-right ml-2"></i></button>
            </div>            

        </form>
    </div>    
@endsection
@push('scripts')
<script>
    tinymce.init({
      selector: '#text'
    });
  </script>
@endpush