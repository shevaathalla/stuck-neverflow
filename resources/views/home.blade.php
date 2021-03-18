@extends('layouts.auth')
@section('title')
    <title>SN Home</title>
@endsection
@section('style')
<style>
    html, body {       
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links > a {
        color: #fff;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
</style>
@endsection
@section('content')
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @guest
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
            @endif
            @endguest            
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md text-white text-bold">
            Stuck Neverflow
        </div>

        <div class="links">
            <a href="{{ route('question.index') }}">Question List</a>
            <a href="{{ route('tag.index') }}">Tag List</a>
            @auth
            <a href="{{ route('dashboard') }}">Dashboard</a>
            @endauth
        </div>
    </div>
</div>
@endsection
