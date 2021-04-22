@extends('layouts.base')
@section('title')
    <title>SN - Tag Article</title>
@endsection
@section('content')
    <h2>{{ $tag->name }} Tag</h2>
    <hr>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ Route::is('tag.question') ? 'active' : '' }}" href="{{ route('tag.question',['tag' => $tag]) }}">Question</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('tag.article') ? 'active' : '' }}" href="{{ route('tag.article',['tag' => $tag]) }}">Article</a>
        </li>
    </ul>
@endsection
