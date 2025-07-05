@extends('layouts.app-dark')

@section('title', 'Edit Kategori')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('partials.sidebar')
        <div class="col-lg-9 col-xl-10 ms-sm-auto px-md-4 py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h2 text-gradient">Edit Kategori</h1>
                <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
            <div class="card bg-dark-2 border-0">
                <div class="card-body p-4">
                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control bg-dark-3 border-0 text-white" id="name" name="name" value="{{ $category->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="icon" class="form-label">Ikon (contoh: fas fa-shopping-cart)</label>
                            <input type="text" class="form-control bg-dark-3 border-0 text-white" id="icon" name="icon" value="{{ $category->icon }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="color" class="form-label">Warna</label>
                            <input type="color" class="form-control form-control-color bg-dark-3 border-0" id="color" name="color" value="{{ $category->color }}" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Tipe</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="expense" value="expense" {{ $category->type == 'expense' ? 'checked' : '' }}>
                                    {{-- PERBAIKAN DI SINI --}}
                                    <label class="form-check-label text-light" for="expense">Pengeluaran</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="income" value="income" {{ $category->type == 'income' ? 'checked' : '' }}>
                                    {{-- PERBAIKAN DI SINI --}}
                                    <label class="form-check-label text-light" for="income">Pemasukan</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
