@extends('layouts.app-dark')

@section('title', 'Detail Target Tabungan')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('partials.sidebar')
        <div class="col-lg-9 col-xl-10 ms-sm-auto px-md-4 py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h2 text-gradient">{{ $savingsTarget->name }}</h1>
                <div>
                    <a href="{{ route('savings-targets.edit', $savingsTarget->id) }}" class="btn btn-warning me-2 rounded-pill"><i class="fas fa-edit me-2"></i>Edit</a>
                    <a href="{{ route('savings-targets.index') }}" class="btn btn-secondary rounded-pill"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
                </div>
            </div>

            <div class="card bg-dark-2 border-0">
                <div class="card-body p-4">
                    @php
                        $progress = ($savingsTarget->target_amount > 0) ? ($savingsTarget->current_amount / $savingsTarget->target_amount) * 100 : 0;
                        $progress = min($progress, 100);
                        // PERBAIKAN DI SINI
                        $daysLeft = $savingsTarget->target_date ? floor(Carbon\Carbon::now()->diffInDays($savingsTarget->target_date, false)) : null;
                    @endphp
                    <div class="text-center mb-4">
                        <div class="progress-circle" data-progress="{{ $progress }}">
                            <span class="progress-text">{{ number_format($progress, 0) }}%</span>
                        </div>
                    </div>

                    <div class="row text-center mb-4">
                        <div class="col-4">
                            <small class="text-muted d-block">Terkumpul</small>
                            <span class="h5 text-light">Rp {{ number_format($savingsTarget->current_amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="col-4">
                            <small class="text-muted d-block">Target</small>
                            <span class="h5 text-light">Rp {{ number_format($savingsTarget->target_amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="col-4">
                            <small class="text-muted d-block">Sisa Hari</small>
                            <span class="h5 text-light">{{ is_numeric($daysLeft) && $daysLeft >= 0 ? $daysLeft : '∞' }}</span>
                        </div>
                    </div>
                    
                    @if($savingsTarget->description)
                    <hr class="border-secondary border-opacity-25">
                    <h5 class="mt-4">Deskripsi</h5>
                    <p class="text-muted">{{ $savingsTarget->description }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .progress-circle {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: conic-gradient(var(--primary-color) calc(var(--progress, 0) * 1%), var(--dark-3) 0);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: auto;
        transition: background 0.5s;
    }
    .progress-text {
        font-size: 2rem;
        font-weight: bold;
        color: white;
    }
</style>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const circle = document.querySelector('.progress-circle');
        if(circle) {
            const progress = circle.getAttribute('data-progress');
            circle.style.setProperty('--progress', progress);
        }
    });
</script>
@endpush
