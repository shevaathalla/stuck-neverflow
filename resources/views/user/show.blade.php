@extends('layouts.base')
@section('title')
    <title>User Detail</title>
@endsection
@section('content')
    <h2>User Detail</h2>
    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-header">
            @if (Auth::id() == $user->id)
            <div class="float-right">
                <a href="{{ route('user.edit',['user'=> Auth::user()]) }}" class="btn btn-success"> Edit Profile</a>
            </div>
            @endif            
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md">
                    <label for="name">Name</label>
                    <h4 class="text-gray-800" name="name">{{ $user->name }}</h4>
                    <label for="name">Email</label>
                    <h4 class="text-gray-800" name="name">{{ $user->email }}</h4>
                    <label for="name">Level</label>
                    <h4 class="text-gray-800" name="name">{{ $user->role->name }}</h4>
                </div>
                <div class="col-md border-left">
                    <div class="row justify-content-md-center">
                        @if ($user->avatar != null)
                        <div class="mb-4 mt-4">
                            <img class="image rounded-circle" src="{{asset('storage/images/'.$user->avatar)}}" style="width: 150px; height: 150px;" alt="">
                        </div>                 
                        @endif                               
                    </div>
                    <div class="row">
                            <div class="col-md">
                                <h5 class="text-center font-weight-bold">Question Posted</h5>
                            </div>
                            <div class="col-md">
                                <h5 class="text-center font-weight-bold">Answer Posted</h5>                                
                            </div>
                            <div class="col-md">
                                <h5 class="text-center font-weight-bold">Points</h5>
                            </div>                                         
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <p class="text-center" >{{ count($user->questions) }}</p>
                        </div>
                        <div class="col-md">
                            <p class="text-center" >{{ count($user->answers) }}</p>
                        </div>
                        <div class="col-md">
                            <p class="text-center" >0</p>
                        </div>                                         
                </div>
                </div>                
            </div>            
        </div>
    </div>
    @endsection
