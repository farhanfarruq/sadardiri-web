@extends('layouts.app-dark')

@section('title', 'Edit Target Tabungan')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('partials.sidebar')
        <div class="col-lg-9 col-xl-10 ms-sm-auto px-md-4 py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h2 text-gradient">Edit Target Tabungan</h1>
                <a href="{{ route('savings-targets.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
            <div class="card bg-dark-2 border-0">
                <div class="card-body p-4">
                    <form action="{{ route('savings-targets.update', $savingsTarget->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label text-light">Nama Target</label>
                            <input type="text" class="form-control bg-dark-3 border-0 text-white" id="name" name="name" value="{{ $savingsTarget->name }}" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="target_amount" class="form-label text-light">Jumlah Target (Rp)</label>
                                <input type="number" class="form-control bg-dark-3 border-0 text-white" id="target_amount" name="target_amount" value="{{ $savingsTarget->target_amount }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="current_amount" class="form-label text-light">Jumlah Saat Ini (Rp)</label>
                                <input type="number" class="form-control bg-dark-3 border-0 text-white" id="current_amount" name="current_amount" value="{{ $savingsTarget->current_amount }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="target_date" class="form-label text-light">Tanggal Target (Opsional)</label>
                            <input type="date" class="form-control bg-dark-3 border-0 text-white" id="target_date" name="target_date" value="{{ optional($savingsTarget->target_date)->format('Y-m-d') }}">
                        </div>
                        <div class="mb-4">
                            <label for="description" class="form-label text-light">Deskripsi (Opsional)</label>
                            <textarea class="form-control bg-dark-3 border-0 text-white" id="description" name="description" rows="3">{{ $savingsTarget->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
