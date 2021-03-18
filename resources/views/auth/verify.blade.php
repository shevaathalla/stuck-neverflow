@extends('layouts.auth')
@section('title')
    <title>SN - Verify Email</title>
@endsection
@section('content')
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg mt-lg-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">Please Verify ur Email</h1>
                                    <p class="mb-4">If you want to access this page you must verfiy ur email first</p>
                                    <p class="mb-2">If you did not receive the email</p>
                                </div>
                                <form class="user" method="POST" action="{{ route('verification.resend') }}">
                                    <div class="form-group">
                                        @csrf
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Click here to request another</button>.
                                    </div>                                        
                                </form>                                                                 
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

@endsection