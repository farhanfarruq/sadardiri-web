@extends('layouts.app-dark')

@section('title', 'Detail Transaksi')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('partials.sidebar')

        <div class="col-lg-9 col-xl-10 ms-sm-auto px-md-4 py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-0 text-gradient">Detail Transaksi</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('transactions.index') }}" class="text-muted text-decoration-none">Keuangan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-warning me-2 rounded-pill">
                        <i class="fas fa-edit me-2"></i>Edit
                    </a>
                    <a href="{{ route('transactions.index') }}" class="btn btn-secondary rounded-pill">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>

            <div class="row g-4">
                {{-- Kolom Kiri: Detail Utama Transaksi --}}
                <div class="col-md-7 col-lg-8">
                    <div class="card bg-dark-2 border-0 h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                @if($transaction->category)
                                <span class="d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px; background-color: {{ $transaction->category->color }}20; border-radius: 12px;">
                                    <i class="{{ $transaction->category->icon }} fa-2x" style="color: {{ $transaction->category->color }};"></i>
                                </span>
                                @endif
                                <div>
                                    <h3 class="card-title mb-0">{{ $transaction->description }}</h3>
                                    <small class="text-muted">{{ $transaction->date->format('l, d F Y') }}</small>
                                </div>
                            </div>
                            
                            <hr class="border-secondary border-opacity-25">

                            <h5 class="mt-4">Rincian</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                    <span class="text-muted">Jumlah</span>
                                    <span class="fw-bold fs-5 {{ $transaction->type == 'income' ? 'text-success' : 'text-danger' }}">
                                        {{ $transaction->type == 'income' ? '+' : '-' }} Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                    </span>
                                </li>
                                <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                    <span class="text-muted">Tipe</span>
                                    <span class="text-light">{{ ucfirst($transaction->type) }}</span>
                                </li>
                                <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                    <span class="text-muted">Kategori</span>
                                    <span class="text-light">{{ $transaction->category->name ?? 'N/A' }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Kolom Kanan: Catatan --}}
                <div class="col-md-5 col-lg-4">
                    <div class="card bg-dark-2 border-0 h-100">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-3"><i class="fas fa-sticky-note me-2"></i>Catatan</h5>
                            <p class="text-muted fst-italic">
                                {{ $transaction->notes ?: 'Tidak ada catatan untuk transaksi ini.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* --- PERBAIKAN WARNA JUDUL KARTU --- */
    .card .card-title {
        color: var(--text-bright) !important;
    }

    .icon-circle-lg {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        border: 2px solid {{ $transaction->color }}50;
    }
    
    .activity-item {
        transition: all 0.3s ease;
    }
    
    .activity-item:hover {
        background-color: rgba(255, 255, 255, 0.05);
    }

    .breadcrumb-item a {
        text-decoration: none;
    }

    .breadcrumb-item.active {
        color: var(--text-bright);
    }
</style>

@endsection
