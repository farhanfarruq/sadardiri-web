@extends('layouts.app-dark')

@section('title', 'Target Tabungan')

@section('styles')
<style>
    /* Responsif untuk mobile */
    @media (max-width: 767.98px) {
        .main-content {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
        
        .mobile-target-card {
            border: 1px solid var(--dark-3);
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
            background-color: var(--dark-2);
        }
        
        .mobile-target-card:hover {
            background-color: var(--dark-3);
        }
        
        .mobile-target-name {
            font-size: 1.1rem;
            font-weight: bold;
        }
        
        .mobile-target-amount {
            font-size: 0.875rem;
            color: var(--text-muted);
        }
        
        .btn-add-mobile {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            border-radius: 50%;
            width: 56px;
            height: 56px;
            box-shadow: 0 4px 12px rgba(108, 92, 231, 0.4);
        }
        
        .btn-add-mobile i {
            font-size: 1.5rem;
        }
        
        .desktop-add-btn {
            display: none;
        }
        
        .page-title {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
    }
    
    @media (min-width: 768px) {
        .mobile-view {
            display: none;
        }
        
        .btn-add-mobile {
            display: none;
        }
        
        .main-content {
            margin-left: 0;
        }
    }
    
    @media (min-width: 992px) {
        .main-content {
            margin-left: auto;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('partials.sidebar')
        
        <div class="col-lg-9 col-xl-10 ms-sm-auto px-md-4 py-4 main-content">
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                <h1 class="h2 text-gradient page-title"><i class="fas fa-piggy-bank me-2"></i>Target Tabungan</h1>
                <a href="{{ route('savings-targets.create') }}" class="btn btn-primary btn-lg rounded-pill desktop-add-btn">
                    <i class="fas fa-plus-circle me-2"></i>Buat Target Baru
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Desktop View -->
            <div class="d-none d-md-block">
                <div class="row g-4">
                    @forelse($savingsTargets as $target)
                        @php
                            $progress = ($target->target_amount > 0) ? ($target->current_amount / $target->target_amount) * 100 : 0;
                            $progress = min($progress, 100);
                        @endphp
                    <div class="col-md-6 col-lg-4">
                        <div class="card bg-dark-2 h-100 shadow-lg">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h4 class="card-title text-light mb-0">{{ $target->name }}</h4>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-dark" type="button" data-bs-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                                            <li><a class="dropdown-item" href="{{ route('savings-targets.show', $target->id) }}"><i class="fas fa-eye fa-fw me-2"></i>Detail</a></li>
                                            <li><a class="dropdown-item" href="{{ route('savings-targets.edit', $target->id) }}"><i class="fas fa-edit fa-fw me-2"></i>Edit</a></li>
                                            <li><button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $target->id }}" data-name="{{ $target->name }}"><i class="fas fa-trash-alt fa-fw me-2"></i>Hapus</button></li>
                                        </ul>
                                    </div>
                                </div>
                                <p class="text-muted small">Rp {{ number_format($target->current_amount, 0, ',', '.') }} / Rp {{ number_format($target->target_amount, 0, ',', '.') }}</p>
                                
                                <div class="progress mt-auto" style="height: 10px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex justify-content-between mt-1">
                                    <small class="text-muted">Tercapai</small>
                                    <small class="text-light fw-bold">{{ number_format($progress, 1) }}%</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="card bg-dark-2 border-0 text-center py-5">
                            <i class="fas fa-bullseye fa-3x text-muted mb-3"></i>
                            <h3 class="h4 text-muted">Belum ada target tabungan</h3>
                            <p class="text-muted">Ayo buat target pertamamu!</p>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Mobile View -->
            <div class="d-md-none mobile-view">
                @forelse($savingsTargets as $target)
                    @php
                        $progress = ($target->target_amount > 0) ? ($target->current_amount / $target->target_amount) * 100 : 0;
                        $progress = min($progress, 100);
                    @endphp
                <div class="mobile-target-card">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h4 class="mobile-target-name">{{ $target->name }}</h4>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-dark" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('savings-targets.show', $target->id) }}"><i class="fas fa-eye fa-fw me-2"></i>Detail</a></li>
                                <li><a class="dropdown-item" href="{{ route('savings-targets.edit', $target->id) }}"><i class="fas fa-edit fa-fw me-2"></i>Edit</a></li>
                                <li><button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $target->id }}" data-name="{{ $target->name }}"><i class="fas fa-trash-alt fa-fw me-2"></i>Hapus</button></li>
                            </ul>
                        </div>
                    </div>
                    
                    <p class="mobile-target-amount mb-3">Rp {{ number_format($target->current_amount, 0, ',', '.') }} / Rp {{ number_format($target->target_amount, 0, ',', '.') }}</p>
                    
                    <div class="progress mb-2" style="height: 8px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $progress }}%;"></div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <small class="text-muted">Tercapai</small>
                        <small class="text-light">{{ number_format($progress, 1) }}%</small>
                    </div>
                </div>
                @empty
                <div class="text-center py-5">
                    <i class="fas fa-bullseye fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">Belum ada target tabungan</h4>
                    <p class="text-muted">Ayo buat target pertamamu!</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Floating Action Button untuk Mobile -->
<a href="{{ route('savings-targets.create') }}" class="btn btn-primary btn-add-mobile d-md-none">
    <i class="fas fa-plus"></i>
</a>

<!-- Modal Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark-3">
            <div class="modal-header border-0">
                <h5 class="modal-title text-danger"><i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="text-light">Anda yakin ingin menghapus target "<strong id="targetName" class="text-light"></strong>"?</p>
            </div>
            <div class="modal-footer border-0">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteModal = document.getElementById('deleteModal');
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const targetId = button.getAttribute('data-id');
            const targetName = button.getAttribute('data-name');
            const form = deleteModal.querySelector('#deleteForm');
            form.action = '/savings-targets/' + targetId;
            deleteModal.querySelector('#targetName').textContent = targetName;
        });
    }
});
</script>
@endpush