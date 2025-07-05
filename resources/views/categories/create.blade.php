@extends('layouts.app-dark')

@section('title', 'Tambah Kategori')

@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- Memasukkan sidebar untuk konsistensi layout --}}
        @include('partials.sidebar')

        {{-- Konten utama dengan kelas kolom yang benar --}}
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Tambah Kategori Baru</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="{{ route('categories.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>
                        Kembali
                    </a>
                </div>
            </div>

            <div class="card bg-dark text-white border-secondary">
                <div class="card-header border-secondary">
                    Formulir Kategori
                </div>
                <div class="card-body">
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="icon" class="form-label">Ikon (contoh: fas fa-shopping-cart)</label>
                            <input type="text" class="form-control" id="icon" name="icon" placeholder="Lihat di Font Awesome 5" required>
                        </div>
                        <div class="mb-3">
                            <label for="color" class="form-label">Warna</label>
                            <input type="color" class="form-control form-control-color" id="color" name="color" value="#ff6347" title="Pilih warna Anda" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Tipe</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="expense" value="expense" checked>
                                    <label class="form-check-label" for="expense">Pengeluaran</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="income" value="income">
                                    <label class="form-check-label" for="income">Pemasukan</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Kategori</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
