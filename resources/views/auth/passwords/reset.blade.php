@extends('layouts.auth')
@section('title')
    <title>SN Reset Password</title>
@endsection
@section('content')
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Reset Password</h1>
                        </div>
                        <form class="user" method="POST" action="{{ route('password.update') }}">                            
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group row">                            
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" name="email"
                                    placeholder="Email Address" autocomplete="email"
                                    value="{{ $email ?? old('email') }}" required>
                                    @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="password"
                                        name="password" required autocomplete="new-password" placeholder="New Password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user"
                                        id="password-confirm" name="password_confirmation" required
                                        autocomplete="new-password" placeholder="Repeat New Password">
                                </div>
                            </div>
                            <input type="submit" value="Reset Your Account"
                                class="btn btn-primary btn-user btn-block">
                            <hr>                        
                        </form>
                        <hr>                   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection