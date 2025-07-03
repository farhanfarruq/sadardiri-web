@extends('layouts.app-dark')

@section('title', 'Detail Kebiasaan')

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
                <div>
                    <h2 class="mb-0">Detail Kebiasaan</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('habits.index') }}">Kebiasaan</a></li>
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

            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card bg-dark-2 border-0 h-100">
                        <div class="card-body text-center">
                            <div class="icon-circle-lg mx-auto mb-3" style="background-color: {{ $habit->color }}20; color: {{ $habit->color }};">
                                <i class="{{ $habit->icon }} fa-2x"></i>
                            </div>
                            <h3 class="card-title">{{ $habit->name }}</h3>
                            <p class="text-muted">{{ $habit->description }}</p>
                            
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <h6 class="text-muted mb-1">Frekuensi</h6>
                                    <span class="badge bg-primary">{{ ucfirst($habit->frequency) }}</span>
                                </div>
                                <div>
                                    <h6 class="text-muted mb-1">Target</h6>
                                    <span class="badge bg-success">{{ $habit->target_count }}x</span>
                                </div>
                            </div>
                            
                            <div class="streak-display mb-3">
                                <h6 class="text-muted mb-2">Streak Saat Ini</h6>
                                <h2 class="text-gradient text-primary">{{ $streak }} hari</h2>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-8 mb-4">
                    <div class="card bg-dark-2 border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Progress Bulan Ini</h5>
                            
                            <div class="progress mb-4" style="height: 10px;">
                                <div class="progress-bar" role="progressbar" 
                                     style="width: {{ $monthlyCompletion }}%; background-color: {{ $habit->color }};">
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between mb-4">
                                <span class="text-muted">{{ $habit->logs()->whereMonth('date', now()->month)->count() }} dari {{ $habit->target_count }} target tercapai</span>
                                <span class="text-primary">{{ round($monthlyCompletion) }}%</span>
                            </div>
                            
                            <h5 class="card-title mb-3">Riwayat Aktivitas</h5>
                            <div class="activity-list">
                                @forelse($logs as $log)
                                <div class="activity-item d-flex justify-content-between align-items-center py-2 border-bottom">
                                    <div>
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        <span>{{ $log->date->format('d M Y') }}</span>
                                    </div>
                                    <span class="badge bg-dark">{{ $log->date->diffForHumans() }}</span>
                                </div>
                                @empty
                                <div class="text-center py-4">
                                    <i class="fas fa-calendar-times fa-2x text-muted mb-3"></i>
                                    <p class="text-muted">Belum ada aktivitas tercatat</p>
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
    .icon-circle-lg {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    
    .activity-item {
        transition: all 0.3s ease;
    }
    
    .activity-item:hover {
        background-color: rgba(255, 255, 255, 0.05);
    }
</style>
@endsection