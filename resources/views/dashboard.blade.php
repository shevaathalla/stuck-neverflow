@extends('layouts.base')
@section('title')
    <title>SN - Dashboard</title>
@endsection
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ Auth::user()->name }} Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-question-circle mr-1 text-white-50"></i> Make Question</a>
</div>
<div class="row">

    <!-- Question Count Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Question Count</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $questions->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-question fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Answer Count Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Article Count</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$articles->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Points
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ Auth::user()->points }}</div>
                            </div>                            
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                          <a href="{{ route('user.notification',['user'=> Auth::user()]) }}" class="text-decoration-none text-warning">  Notification</a>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ Auth::user()->notifications->where('read_status','0')->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('user.notification',['user'=> Auth::user()]) }}" class="fas fa-bell fa-2x text-gray-300 text-decoration-none"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection