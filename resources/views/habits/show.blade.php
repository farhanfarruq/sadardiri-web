@extends('layouts.app-dark')

@section('title', 'Detail Kebiasaan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Main Content -->
        <div class="col-lg-9 col-xl-10 content ms-auto py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-0 text-gradient">Detail Kebiasaan</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('habits.index') }}" class="text-muted">Kebiasaan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('habits.edit', $habit->id) }}" class="btn btn-warning me-2">
                        <i class="fas fa-edit me-2"></i>Edit
                    </a>
                    <a href="{{ route('habits.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>

            <div class="row g-4">
                {{-- Kartu Detail Kebiasaan --}}
                <div class="col-md-4 mb-4">
                    <div class="card bg-dark-2 border-0 h-100 p-3">
                        <div class="card-body text-center d-flex flex-column">
                            <div class="icon-circle-lg mx-auto mb-3" style="background-color: {{ $habit->color }}20; color: {{ $habit->color }};">
                                <i class="{{ $habit->icon }} fa-2x"></i>
                            </div>
                            <h3 class="card-title h4">{{ $habit->name }}</h3>
                            <p class="text-muted">{{ $habit->description }}</p>
                            
                            <div class="mt-auto">
                                <div class="d-flex justify-content-around my-4">
                                    <div>
                                        <h6 class="text-muted mb-1">Frekuensi</h6>
                                        <span class="badge bg-primary fs-6">{{ ucfirst($habit->frequency) }}</span>
                                    </div>
                                    <div>
                                        <h6 class="text-muted mb-1">Target</h6>
                                        <span class="badge bg-success fs-6">{{ $habit->target_count }}x</span>
                                    </div>
                                </div>
                                
                                <div class="streak-display">
                                    <h6 class="text-muted mb-2">Streak Saat Ini</h6>
                                    <h2 class="text-gradient display-4">{{ $streak }} hari</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Kartu Progress dan Riwayat --}}
                <div class="col-md-8 mb-4">
                    <div class="card bg-dark-2 border-0 h-100">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-2">Progress Bulan Ini</h5>
                            <p class="text-muted small">Berdasarkan target bulanan Anda.</p>
                            
                            <div class="progress mb-2" style="height: 12px; background-color: var(--dark-3);">
                                <div class="progress-bar" role="progressbar" 
                                     style="width: {{ $monthlyCompletion }}%; background-color: {{ $habit->color }};">
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between mb-4">
                                <span class="text-muted">{{ $habit->logs()->whereMonth('date', now()->month)->count() }} dari {{ $habit->target_count }} target tercapai</span>
                                <span class="text-primary fw-bold">{{ round($monthlyCompletion) }}%</span>
                            </div>
                            
                            <h5 class="card-title mb-3">Riwayat Aktivitas</h5>
                            <div class="activity-list" style="max-height: 250px; overflow-y: auto;">
                                @forelse($logs as $log)
                                <div class="activity-item d-flex justify-content-between align-items-center py-2 px-3 border-bottom border-dark-3">
                                    <div>
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        <span>{{ $log->date->format('d M Y') }}</span>
                                    </div>
                                    <span class="badge bg-dark-3 text-muted">{{ $log->date->diffForHumans() }}</span>
                                </div>
                                @empty
                                <div class="text-center py-5">
                                    <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Belum ada aktivitas tercatat bulan ini.</p>
                                </div>
                                @endforelse
                            </div>
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
        border: 2px solid {{ $habit->color }}50;
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
