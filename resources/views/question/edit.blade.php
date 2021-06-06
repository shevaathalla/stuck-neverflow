@extends('layouts.base')
@section('title')
    <title>SN - Edit</title>
@endsection
@section('js')
    <script src="https://cdn.tiny.cloud/1/{{ env('TINY_API') }}/tinymce/5/tinymce.min.js" referrerpolicy="origin">
    </script>

@endsection
@section('content')
    <h2 class="text-gray-700">
        Edit Question
    </h2>
    <hr class="">
    <div class="col-md-12">
        <form action="{{ route('question.update', ['question' => $question]) }}" method="post">
            @csrf
            @method('PUT')
            <label for="title" class="col-form-label text-gray-700">Title</label>
            <input type="text" name="title" id="title" class="form-control" required value="{{ $question->title }}">
            <label for="content" class="col-form-label text-gray-700">Text</label>
            <textarea name="text" id="text" cols="30" rows="10">
                    {{ $question->text }}
                </textarea>
            <div class="my-4">
                <button type="submit" onclick="return confirm('Yakin ingin mengedit pertanyaan ini?')"
                    class="btn btn-primary mr-auto"><i class="fas fa-upload"> Update</i></button>
                <input type="reset" value="Reset" class="btn btn-secondary">
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        tinymce.init({
            selector: '#text',
            plugins: 'a11ychecker advcode casechange linkchecker autolink lists checklist permanentpen powerpaste table advtable  tinymcespellchecker',
            toolbar: 'a11ycheck casechange checklist code permanentpen table',
            toolbar_mode: 'floating',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
        });

    </script>
@endpush
