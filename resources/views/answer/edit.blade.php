@extends('layouts.base')
@section('title')
    <title>SN - Edit Answer</title>
@endsection
@section('js')
<script src="https://cdn.tiny.cloud/1/{{ env('TINY_API') }}/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
@endsection
@section('content')
<h2 class="text-gray-700">
    Edit Answer
</h2>
<hr class="">
    <div class="col-md-12">
        <form action="{{ route('answer.update', ['question' => $question, 'answer' => $answer]) }}" method="post">
            @csrf
            @method('PUT')                        
            <label for="content" class="col-form-label text-gray-700" >Your Answer Below</label>
            <textarea name="text" id="text" cols="30" rows="10">
                {{ $answer->text }}
            </textarea>
            <div class="my-4">
                <button type="submit" onclick="return confirm('Yakin ingin mengedit pertanyaan ini?')" class="btn btn-primary mr-auto"><i class="fas fa-upload"> Update</i></button>
                <input type="reset" value="Reset" class="btn btn-secondary">
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