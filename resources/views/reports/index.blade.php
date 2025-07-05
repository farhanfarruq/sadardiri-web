@extends('layouts.app-dark')

@section('title', 'Laporan Aktivitas')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('partials.sidebar')
        <div class="col-lg-9 col-xl-10 ms-sm-auto px-md-4 py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h2 text-gradient"><i class="fas fa-history me-2"></i>Laporan Aktivitas</h1>
                {{-- Tombol export bisa ditambahkan di sini nanti --}}
            </div>

            <div class="card bg-dark-2 border-0">
                <div class="card-body p-0">
                    @if($history->isEmpty())
                        <div class="text-center py-5">
                            <i class="fas fa-folder-open fa-4x text-muted mb-4"></i>
                            <h4 class="text-muted">Belum ada aktivitas tercatat.</h4>
                            <p class="text-muted">Mulai lacak kebiasaan dan keuangan Anda untuk melihat laporan di sini.</p>
                        </div>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach($history as $item)
                                <li class="list-group-item bg-dark-2 text-light border-bottom border-secondary border-opacity-25 py-3">
                                    <div class="d-flex w-100 justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            @if($item->activity_type == 'transaction')
                                                <div class="icon-circle-sm me-3 bg-{{ $item->type == 'income' ? 'success' : 'danger' }} bg-opacity-10">
                                                    <i class="fas fa-wallet text-{{ $item->type == 'income' ? 'success' : 'danger' }}"></i>
                                                </div>
                                                <div>
                                                    <strong class="d-block">{{ $item->description }}</strong>
                                                    <small class="text-muted">
                                                        Kategori: {{ $item->category->name ?? 'Tanpa Kategori' }}
                                                    </small>
                                                </div>
                                            @else
                                                <div class="icon-circle-sm me-3" style="background-color: {{ $item->habit->color }}20;">
                                                    <i class="{{ $item->habit->icon }}" style="color: {{ $item->habit->color }};"></i>
                                                </div>
                                                <div>
                                                    <strong class="d-block">Kebiasaan: {{ $item->habit->name }}</strong>
                                                    <small class="text-muted">
                                                        Berhasil diselesaikan
                                                    </small>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="text-end">
                                            @if($item->activity_type == 'transaction')
                                                <span class="fw-bold d-block text-{{ $item->type == 'income' ? 'success' : 'danger' }}">
                                                    {{ $item->type == 'income' ? '+' : '-' }} Rp {{ number_format($item->amount, 0, ',', '.') }}
                                                </span>
                                            @endif
                                            <small class="text-muted">{{ $item->activity_date->format('d M Y') }}</small>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.icon-circle-sm {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
</style>
@endsection
