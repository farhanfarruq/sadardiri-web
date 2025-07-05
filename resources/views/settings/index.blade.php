@extends('layouts.app-dark')

@section('title', 'Pengaturan')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('partials.sidebar')
        <div class="col-lg-9 col-xl-10 ms-sm-auto px-md-4 py-4">
            <h1 class="h2 text-gradient mb-4"><i class="fas fa-cog me-2"></i>Pengaturan</h1>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card bg-dark-2 border-0 mb-4">
                        <div class="card-header bg-dark-3 py-3">
                            <h5 class="mb-0 text-light"><i class="fas fa-user-circle me-2"></i>Akun</h5>
                        </div>
                        <div class="card-body p-4">
                            <p class="text-light">Anda login sebagai:</p>
                            <h4 class="text-primary">{{ Auth::user()->name }}</h4>
                            <p class="text-muted">{{ Auth::user()->email }}</p>
                            <hr class="border-secondary border-opacity-25">
                            <a href="{{ route('register') }}" class="btn btn-outline-info me-2 mb-2"><i class="fas fa-user-plus me-2"></i>Buat Akun Baru</a>
                            <a href="{{ route('logout') }}"
                               class="btn btn-outline-danger mb-2"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                     <div class="card bg-dark-2 border-0 mb-4">
                        <div class="card-header bg-dark-3 py-3">
                            <h5 class="mb-0 text-light"><i class="fas fa-palette me-2"></i>Tampilan</h5>
                        </div>
                        <div class="card-body p-4">
                            <p class="text-light">Pilih tema antarmuka aplikasi.</p>
                            <div class="form-check form-switch form-check-inline fs-5">
                              <input class="form-check-input" type="checkbox" id="themeSwitch" checked disabled>
                              <label class="form-check-label text-light" for="themeSwitch">Dark Mode</label>
                            </div>
                            <p class="text-muted small mt-3">
                                <i class="fas fa-info-circle me-1"></i>
                                Fitur Light Mode akan segera hadir.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
