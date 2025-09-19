@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('content')
<div class="login-box">
      <div class="card card-outline card-primary">
            <div class="card-header text-center">
                  <h2><b>Forgot Password</b></h2>
            </div>
            <div class="card-body">

                  @if(session('success'))
                  <div class="alert alert-success">
                        {{ session('success') }}
                  </div>
                  @endif

                  @if($errors->any())
                  <div class="alert alert-danger">
                        {{ $errors->first('email') }}
                  </div>
                  @endif

                  <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="input-group mb-3">
                              <input type="email" name="email" class="form-control" placeholder="Email" required>
                              <div class="input-group-append">
                                    <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                              </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Send Reset Link</button>
                  </form>

                  <p class="mt-3 mb-0 text-center">
                        <a href="{{ route('login') }}">Back to Login</a>
                  </p>
            </div>
      </div>
</div>
@endsection