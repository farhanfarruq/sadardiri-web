@extends('layouts.app-dark')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card bg-dark-2 border-0 shadow-lg">
                <div class="card-header bg-transparent border-0 text-center py-4">
                    <h2 class="text-gradient text-primary">Welcome Back</h2>
                    <p class="text-muted">Login to continue your journey</p>
                </div>

                <div class="card-body px-5 py-4">
                    {{-- Menampilkan pesan error dari Google Auth --}}
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label text-light">{{ __('Alamat E-Mail') }}</label>
                            <input id="email" type="email" class="form-control bg-dark border-0 @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                   style="color: #fff; height: 50px;">
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label text-light">{{ __('Kata Sandi') }}</label>
                            <input id="password" type="password" class="form-control bg-dark border-0 @error('password') is-invalid @enderror" 
                                   name="password" required autocomplete="current-password"
                                   style="color: #fff; height: 50px;">
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label text-muted" for="remember">
                                    {{ __('Ingat Saya') }}
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="btn btn-link text-muted text-decoration-none" href="{{ route('password.request') }}">
                                    {{ __('Lupa Kata Sandi?') }}
                                </a>
                            @endif
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill py-3">
                                {{ __('Login') }}
                            </button>
                        </div>
                        
                        <div class="d-grid">
                             <a href="{{ route('auth.google') }}" class="btn btn-outline-light btn-lg rounded-pill py-3">
                                <i class="fab fa-google me-2"></i> Login dengan Google
                            </a>
                        </div>

                        <div class="text-center text-muted mt-4">
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
