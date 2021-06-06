@extends('layouts.base')
@section('title')
    <title>SN - Create Answer</title>
@endsection
@section('js')
<script src="https://cdn.tiny.cloud/1/{{ env('TINY_API') }}/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
@endsection
@section('content')
<h2 class="text-gray-700">
    Make Answer
</h2>
<hr class="">
    <div class="col-md-12">
        <form action="{{ route('answer.store',['question'=>$question])}}" method="post">
            @csrf                     
            <label for="content" class="col-form-label text-gray-700" >Type your answer below</label>
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