@extends('layouts.app-dark')

@section('title', 'Edit Kebiasaan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3 col-xl-2 px-0 sidebar">
            <nav class="nav flex-column pt-3">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-home me-2"></i>Dashboard
                </a>
                <a class="nav-link active" href="{{ route('habits.index') }}">
                    <i class="fas fa-check-circle me-2"></i>Kebiasaan
                </a>
                <!-- Menu lainnya -->
            </nav>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9 col-xl-10 content ms-auto py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Edit Kebiasaan</h2>
                <a href="{{ route('habits.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            <div class="card bg-dark-2 border-0">
                <div class="card-body p-4">
                    <form action="{{ route('habits.update', $habit->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="form-label text-light">Nama Kebiasaan</label>
                            <input type="text" class="form-control bg-dark border-0 @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $habit->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label text-light">Deskripsi</label>
                            <textarea class="form-control bg-dark border-0 @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3">{{ old('description', $habit->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="icon" class="form-label text-light">Icon</label>
                                <select class="form-select bg-dark border-0 @error('icon') is-invalid @enderror" 
                                        id="icon" name="icon" required>
                                    <option value="">Pilih Icon</option>
                                    <option value="fas fa-running" {{ old('icon', $habit->icon) == 'fas fa-running' ? 'selected' : '' }}>Lari</option>
                                    <option value="fas fa-book" {{ old('icon', $habit->icon) == 'fas fa-book' ? 'selected' : '' }}>Baca</option>
                                    <option value="fas fa-utensils" {{ old('icon', $habit->icon) == 'fas fa-utensils' ? 'selected' : '' }}>Makan</option>
                                    <!-- Tambahkan lebih banyak opsi -->
                                </select>
                                @error('icon')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="frequency" class="form-label text-light">Frekuensi</label>
                                <select class="form-select bg-dark border-0 @error('frequency') is-invalid @enderror" 
                                        id="frequency" name="frequency" required>
                                    <option value="">Pilih Frekuensi</option>
                                    <option value="daily" {{ old('frequency', $habit->frequency) == 'daily' ? 'selected' : '' }}>Harian</option>
                                    <option value="weekly" {{ old('frequency', $habit->frequency) == 'weekly' ? 'selected' : '' }}>Mingguan</option>
                                    <option value="monthly" {{ old('frequency', $habit->frequency) == 'monthly' ? 'selected' : '' }}>Bulanan</option>
                                </select>
                                @error('frequency')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="target_count" class="form-label text-light">Target</label>
                                <input type="number" class="form-control bg-dark border-0 @error('target_count') is-invalid @enderror" 
                                       id="target_count" name="target_count" value="{{ old('target_count', $habit->target_count) }}" min="1" required>
                                @error('target_count')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="color" class="form-label text-light">Warna</label>
                                <input type="color" class="form-control form-control-color bg-dark border-0 @error('color') is-invalid @enderror" 
                                       id="color" name="color" value="{{ old('color', $habit->color) }}" required>
                                @error('color')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection