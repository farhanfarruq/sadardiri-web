@extends('layouts.app-dark')

@section('title', 'Tambah Transaksi Baru')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('partials.sidebar')

        <div class="col-lg-9 col-xl-10 ms-sm-auto px-md-4 py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h2 text-gradient">
                    <i class="fas fa-plus-circle me-2"></i>Tambah Transaksi
                </h1>
                <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            <div class="card bg-dark-2 border-0">
                <div class="card-body p-4">
                    <form action="{{ route('transactions.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="description" class="form-label">Deskripsi</label>
                                <input type="text" class="form-control bg-dark-3 border-0 text-white @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description') }}" required>
                                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="amount" class="form-label">Jumlah (Rp)</label>
                                <input type="number" step="any" class="form-control bg-dark-3 border-0 text-white @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount') }}" required>
                                @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="category_id" class="form-label">Kategori</label>
                                <select class="form-select bg-dark-3 border-0 text-white @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                    <option value="" disabled selected>Pilih Kategori...</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }} ({{ ucfirst($category->type) }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="date" class="form-label">Tanggal</label>
                                <input type="date" class="form-control bg-dark-3 border-0 text-white @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required>
                                @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tipe Transaksi</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="expense" value="expense" {{ old('type', 'expense') == 'expense' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="expense">Pengeluaran</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="income" value="income" {{ old('type') == 'income' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="income">Pemasukan</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="notes" class="form-label">Catatan (Opsional)</label>
                            <textarea class="form-control bg-dark-3 border-0 text-white" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Simpan Transaksi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
