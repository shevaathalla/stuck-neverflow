@extends('layouts.auth')
@section('title')
    <title>SN Home</title>
@endsection
@section('style')
    <style>
        html,
        body {
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

        .links>a {
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
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
                @auth
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                @endauth
            </div>
        @endif

        <div class="content">
            <div class="title m-b-md text-white text-bold">
                Stuck Neverflow
            </div>

            <div class="links">
                <a href="{{ route('question.index') }}">Question List</a>
                <a href="{{ route('tag.index') }}">Tag List</a>
                <a href="{{ route('article.index') }}">Article List</a>
                @auth
                    <a href="{{ route('dashboard',['user' => Auth::user()]) }}">Dashboard</a>
                @endauth
            </div>
            <form action="{{ route('tag.search') }}" method="post">
                @csrf
            <div class="row mt-2">                
                    <div class="col-md-2 pt-1">
                        <div class="float-left">
                            <div class="text-white font-weight-bold">
                                <h6>Search Tag</h6>
                            </div>
                        </div>                        
                    </div>
                    <div class="col-md-8">
                        <select class="js-example-basic-single form-control-lg w-100 text-gray-900" id="searchTag" style="height: 100%" name="tag">
                            @foreach ($tags as $tag)
                                <option></option>
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn-block btn-success shadow rounded "><i class="fas fa-search"></i></button>
                    </div>                
            </div>
        </form>                
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#searchTag').select2({
                placeholder: "Search tags",                
            });
        });

    </script>
@endsection
