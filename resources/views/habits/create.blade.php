@extends('layouts.app-dark')

@section('title', 'Tambah Kebiasaan Baru')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Main Content -->
        <div class="col-lg-9 col-xl-10 content ms-auto py-4 px-md-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0 text-gradient">Tambah Kebiasaan Baru</h2>
                <a href="{{ route('habits.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            <div class="card bg-dark-2 border-0">
                <div class="card-body p-4">
                    <form action="{{ route('habits.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="form-label">Nama Kebiasaan</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="icon" class="form-label">Icon</label>
                                <select class="form-select @error('icon') is-invalid @enderror" id="icon" name="icon" required>
                                    <option value="" selected disabled>Pilih Icon...</option>
                                    <option value="fas fa-running" {{ old('icon') == 'fas fa-running' ? 'selected' : '' }}>🏃‍♂️ Lari</option>
                                    <option value="fas fa-book" {{ old('icon') == 'fas fa-book' ? 'selected' : '' }}>📚 Baca</option>
                                    <option value="fas fa-utensils" {{ old('icon') == 'fas fa-utensils' ? 'selected' : '' }}>🍽️ Makan Sehat</option>
                                    <option value="fas fa-dumbbell" {{ old('icon') == 'fas fa-dumbbell' ? 'selected' : '' }}>🏋️ Olahraga</option>
                                    <option value="fas fa-bed" {{ old('icon') == 'fas fa-bed' ? 'selected' : '' }}>😴 Tidur Cukup</option>
                                    <option value="fas fa-tint" {{ old('icon') == 'fas fa-tint' ? 'selected' : '' }}>💧 Minum Air</option>
                                </select>
                                @error('icon')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="frequency" class="form-label">Frekuensi</label>
                                <select class="form-select @error('frequency') is-invalid @enderror" id="frequency" name="frequency" required>
                                    <option value="" selected disabled>Pilih Frekuensi...</option>
                                    <option value="daily" {{ old('frequency') == 'daily' ? 'selected' : '' }}>Harian</option>
                                    <option value="weekly" {{ old('frequency') == 'weekly' ? 'selected' : '' }}>Mingguan</option>
                                    <option value="monthly" {{ old('frequency') == 'monthly' ? 'selected' : '' }}>Bulanan</option>
                                </select>
                                @error('frequency')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="target_count" class="form-label">Target</label>
                                <input type="number" class="form-control @error('target_count') is-invalid @enderror" 
                                       id="target_count" name="target_count" value="{{ old('target_count', 1) }}" min="1" required>
                                @error('target_count')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="color" class="form-label">Warna</label>
                                <input type="color" class="form-control form-control-color @error('color') is-invalid @enderror" 
                                       id="color" name="color" value="{{ old('color', '#6c5ce7') }}" required>
                                @error('color')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>Simpan Kebiasaan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
