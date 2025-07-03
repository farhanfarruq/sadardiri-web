@extends('layouts.app-dark')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card bg-dark-2 border-0 shadow-lg">
                <div class="card-header bg-transparent border-0 text-center py-4">
                    <h2 class="text-gradient text-primary">Welcome Back</h2>
                    <p class="text-muted">Sign in to continue</p>
                </div>

                <div class="card-body px-5 py-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label text-light">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control bg-dark border-0 @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                   style="color: #fff; height: 50px;">

                            @error('email')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label text-light">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control bg-dark border-0 @error('password') is-invalid @enderror" 
                                   name="password" required autocomplete="current-password"
                                   style="color: #fff; height: 50px;">

                            @error('password')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label text-muted" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>

                            @if (Route::has('password.request'))
                                <a class="text-primary text-decoration-none" href="{{ route('password.request') }}">
                                    {{ __('Forgot Password?') }}
                                </a>
                            @endif
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill py-3">
                                {{ __('Login') }}
                            </button>
                        </div>

                        <div class="text-center text-muted">
                            Don't have an account? 
                            <a href="{{ route('register') }}" class="text-primary text-decoration-none">
                                Register here
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection