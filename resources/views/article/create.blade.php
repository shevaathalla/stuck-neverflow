@extends('layouts.base')

@section('title')
    <title>SN - Create Article</title>
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('js')
<script src="https://cdn.tiny.cloud/1/u5e9kia2orymj5g7dyaljpmlw0is3g5f5aoz9lfopki3park/tinymce/5/tinymce.min.js"
referrerpolicy="origin"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

@endsection
@section('content')
    <h2 class="text-gray-700">
        Create Article
    </h2>
    <hr class="">
    <div class="col-md-12">
        <form action="{{ route('article.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col">
                    <label for="title" class="col-form-label text-gray-700">Title</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>
                <div class="col">
                    <label for="thumbnail" class="col-form-label">Thumbnail</label>
                    <input type="file" name="thumbnail" id="thumbnail" class="form-control-file">
                </div>
            </div>
            <label for="text" class="col-form-label text-gray-700">Content</label>
            <textarea name="text" id="text" cols="30" rows="10"></textarea>
            <label for="tag[]" class="col-form-label">Tags</label>
            <select class="form-control select2 select-tags" name="tag[]" id="tags" multiple>
                @foreach ($tags as $tag)
                    <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                @endforeach
            </select>
            <small id="tagsHelp" class="form-text text-muted">Separate ur tags using comma ( , )</small>
            <div class="my-4">
                <button type="submit">Submit</button>
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

@push('scripts')
    <script>
        $(function() {
            $(".select-tags").select2({
                placeholder: "Enter tags",
                tags: true,
                tokenSeparators: [',']
            });
        });

    </script>
@endpush
