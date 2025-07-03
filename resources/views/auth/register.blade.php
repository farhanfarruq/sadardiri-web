@extends('layouts.app-dark')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card bg-dark-2 border-0 shadow-lg">
                <div class="card-header bg-transparent border-0 text-center py-4">
                    <h2 class="text-gradient text-primary">Create Account</h2>
                    <p class="text-muted">Get started with your journey</p>
                </div>

                <div class="card-body px-5 py-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="form-label text-light">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control bg-dark border-0 @error('name') is-invalid @enderror" 
                                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                   style="color: #fff; height: 50px;">

                            @error('name')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label text-light">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control bg-dark border-0 @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" required autocomplete="email"
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
                                   name="password" required autocomplete="new-password"
                                   style="color: #fff; height: 50px;">

                            @error('password')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="form-label text-light">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control bg-dark border-0" 
                                   name="password_confirmation" required autocomplete="new-password"
                                   style="color: #fff; height: 50px;">
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill py-3">
                                {{ __('Register') }}
                            </button>
                        </div>

                        <div class="text-center text-muted">
                            Already have an account? 
                            <a href="{{ route('login') }}" class="text-primary text-decoration-none">
                                Login here
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection