@extends('layouts.app-dark')

@section('title', 'Manajemen Kebiasaan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('partials.sidebar')
        
        <!-- Main Content -->
        <div class="col-lg-9 col-xl-10 ms-sm-auto px-md-4 py-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                <h1 class="h2 text-gradient">
                    <i class="fas fa-check-circle me-2"></i>Daftar Kebiasaan
                </h1>
                <a href="{{ route('habits.create') }}" class="btn btn-primary btn-lg rounded-pill">
                    <i class="fas fa-plus-circle me-2"></i>Tambah Baru
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row g-4">
                @forelse($habits as $habit)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card habit-card border-0 shadow-lg h-100" 
                         style="border-left: 4px solid {{ $habit->color }};">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="habit-icon me-3" style="color: {{ $habit->color }};">
                                        <i class="{{ $habit->icon }} fa-2x"></i>
                                    </div>
                                    <div>
                                        <h3 class="h5 mb-1">{{ $habit->name }}</h3>
                                        <span class="badge bg-dark text-white">{{ ucfirst($habit->frequency) }}</span>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-link text-muted" type="button" 
                                            data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('habits.show', $habit->id) }}">
                                                <i class="fas fa-eye me-2"></i>Detail
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('habits.edit', $habit->id) }}">
                                                <i class="fas fa-edit me-2"></i>Edit
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <button class="dropdown-item text-danger" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteModal"
                                                    data-habit-id="{{ $habit->id }}"
                                                    data-habit-name="{{ $habit->name }}">
                                                <i class="fas fa-trash-alt me-2"></i>Hapus
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <p class="text-muted mt-3">{{ $habit->description ?: 'Tidak ada deskripsi' }}</p>

                            <div class="progress mb-3" style="height: 8px;">
                                <div class="progress-bar" role="progressbar" 
                                     style="width: {{ $habit->getCompletionPercentage() }}%; 
                                            background-color: {{ $habit->color }};">
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <span class="small text-muted">
                                    {{ $habit->logs_count }} dari {{ $habit->target_count }} target
                                </span>
                                <span class="badge bg-dark">
                                    {{ round($habit->getCompletionPercentage()) }}%
                                </span>
                            </div>
                        </div>
                        <div class="card-footer bg-dark-2 border-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="fas fa-calendar-day me-1"></i>
                                    {{ $habit->created_at->format('d M Y') }}
                                </small>
                                <button class="btn btn-sm {{ $habit->is_today_completed ? 'btn-success' : 'btn-outline-secondary' }}"
                                        onclick="toggleHabit({{ $habit->id }})">
                                    <i class="fas fa-{{ $habit->is_today_completed ? 'check' : 'plus' }}"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="card bg-dark-2 border-0 text-center py-5">
                        <i class="fas fa-check-circle fa-4x text-muted mb-4"></i>
                        <h3 class="h4 text-muted">Belum ada kebiasaan</h3>
                        <p class="text-muted">Mulai dengan menambahkan kebiasaan baru</p>
                        <a href="{{ route('habits.create') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-plus me-2"></i>Tambah Kebiasaan
                        </a>
                    </div>
                </div>
                @endforelse
            </div>

            @if($habits->hasPages())
            <div class="mt-4">
                {{ $habits->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark-2 border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title text-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Penghapusan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="lead">Anda yakin ingin menghapus kebiasaan "<strong id="habitName"></strong>"?</p>
                <p class="text-muted small">Semua data terkait kebiasaan ini akan terhapus permanen dan tidak dapat dikembalikan.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Batal
                </button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill">
                        <i class="fas fa-trash-alt me-2"></i>Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Delete Modal Handler
    const deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const habitId = button.getAttribute('data-habit-id');
        const habitName = button.getAttribute('data-habit-name');
        
        document.getElementById('habitName').textContent = habitName;
        document.getElementById('deleteForm').action = `/habits/${habitId}`;
    });

    // Toggle Habit Completion
    function toggleHabit(habitId) {
        fetch(`/habits/${habitId}/toggle`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.status === 'success') {
                window.location.reload();
            }
        });
    }
</script>

<style>
    .habit-card {
        transition: all 0.3s ease;
        background-color: var(--dark-2);
    }
    
    .habit-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
    }
    
    .habit-icon {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background-color: rgba(var(--primary-rgb), 0.1);
    }
    
    .progress {
        background-color: var(--dark-3);
        border-radius: 4px;
    }
    
    .dropdown-menu-dark {
        background-color: var(--dark-3);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .dropdown-item:hover {
        background-color: rgba(255, 255, 255, 0.05);
    }
</style>
@endsection