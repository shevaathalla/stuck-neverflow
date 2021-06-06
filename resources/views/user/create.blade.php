@extends('layouts.base')
@section('title')
    <title>SN - Make Account</title>
@endsection
@section('content')
    <h2>Make User</h2>
    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card">        
        <form action="{{ route('user.store') }}" method="post" autocomplete="off">
            @csrf
        <div class="card-header text-primary font-weight-bold">            
                Fill this form and click the green button to add new user            
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="name" class="form-label">
                        Name<span class="small text-danger"> *</span>
                    </label>
                    <input type="text" name="name" id="name" class="form-control" required placeholder="Name">
                </div>
                <div class="col-md-6">
                    <label for="name" class="form-label">
                        Role<span class="small text-danger"> *</span>
                    </label>
                    <select name="role" id="role" class="form-control @error('name') is-invalid @enderror">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-12">                    
                    <label for="email" class="form-label">
                        Email<span class="small text-danger"> *</span>
                    </label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" required 
                    placeholder="Email" autocomplete="email">
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="password" class="form-label">
                        Password<span class="small text-danger"> *</span>
                    </label>
                    <input type="password" name="password" id="password @error('password') is-invalid @enderror " class="form-control" required 
                    placeholder="Password" autocomplete="new-password">
                </div>
                <div class="col">
                    <label for="password_confirmation" class="form-label">
                        Confirm Password<span class="small text-danger"> *</span>
                    </label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required 
                    placeholder="Retype Password" autocomplete="new-password">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-success float-md-right font-weight-bold">Add new account</button>
                </div>
            </div>            
        </div>
    </form>
    </div>
@endsection
