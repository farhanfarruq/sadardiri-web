@extends('layouts.app-dark')

@section('title', 'Manajemen Kategori')

@section('styles')
<style>
    /* Responsif untuk mobile */
    @media (max-width: 767.98px) {
        .main-content {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
        
        .mobile-category-card {
            border: 1px solid var(--dark-3);
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
            background-color: var(--dark-2);
        }
        
        .mobile-category-card:hover {
            background-color: var(--dark-3);
        }
        
        .mobile-category-name {
            font-size: 1.1rem;
            font-weight: bold;
        }
        
        .mobile-category-type {
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
                <h1 class="h2 text-gradient page-title"><i class="fas fa-tags me-2"></i>Manajemen Kategori</h1>
                <a href="{{ route('categories.create') }}" class="btn btn-primary btn-lg rounded-pill desktop-add-btn">
                    <i class="fas fa-plus-circle me-2"></i>Tambah Kategori
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show animate__animated animate__fadeIn">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Desktop View -->
            <div class="d-none d-md-block">
                <div class="row">
                    <!-- Kolom Pemasukan -->
                    <div class="col-lg-6 mb-4">
                        <h4 class="mb-3 text-success"><i class="fas fa-arrow-down me-2"></i>Kategori Pemasukan</h4>
                        @forelse($incomeCategories as $category)
                        <div class="card bg-dark-2 mb-3">
                            <div class="card-body d-flex justify-content-between align-items-center p-3">
                                <div class="d-flex align-items-center">
                                    <span class="d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; background-color: {{ $category->color }}20; border-radius: 50%;">
                                        <i class="{{ $category->icon }} fa-lg" style="color: {{ $category->color }};"></i>
                                    </span>
                                    <span class="fw-bold text-light">{{ $category->name }}</span>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-dark" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>
                                    <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                                        <li><a class="dropdown-item" href="{{ route('categories.edit', $category->id) }}"><i class="fas fa-edit fa-fw me-2"></i>Edit</a></li>
                                        <li><button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal" data-id="{{ $category->id }}" data-name="{{ $category->name }}"><i class="fas fa-trash-alt fa-fw me-2"></i>Hapus</button></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="card bg-dark-2">
                            <div class="card-body text-center py-4">
                                <i class="fas fa-tags fa-2x text-muted mb-3"></i>
                                <p class="text-muted mb-0">Belum ada kategori pemasukan</p>
                            </div>
                        </div>
                        @endforelse
                    </div>

                    <!-- Kolom Pengeluaran -->
                    <div class="col-lg-6 mb-4">
                        <h4 class="mb-3 text-danger"><i class="fas fa-arrow-up me-2"></i>Kategori Pengeluaran</h4>
                        @forelse($expenseCategories as $category)
                        <div class="card bg-dark-2 mb-3">
                            <div class="card-body d-flex justify-content-between align-items-center p-3">
                                <div class="d-flex align-items-center">
                                    <span class="d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; background-color: {{ $category->color }}20; border-radius: 50%;">
                                        <i class="{{ $category->icon }} fa-lg" style="color: {{ $category->color }};"></i>
                                    </span>
                                    <span class="fw-bold text-light">{{ $category->name }}</span>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-dark" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>
                                    <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                                        <li><a class="dropdown-item" href="{{ route('categories.edit', $category->id) }}"><i class="fas fa-edit fa-fw me-2"></i>Edit</a></li>
                                        <li><button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal" data-id="{{ $category->id }}" data-name="{{ $category->name }}"><i class="fas fa-trash-alt fa-fw me-2"></i>Hapus</button></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="card bg-dark-2">
                            <div class="card-body text-center py-4">
                                <i class="fas fa-tags fa-2x text-muted mb-3"></i>
                                <p class="text-muted mb-0">Belum ada kategori pengeluaran</p>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Mobile View -->
            <div class="d-md-none mobile-view">
                <h4 class="text-success mb-3"><i class="fas fa-arrow-down me-2"></i>Pemasukan</h4>
                @forelse($incomeCategories as $category)
                <div class="mobile-category-card">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="d-flex align-items-center">
                            <span class="d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; background-color: {{ $category->color }}20; border-radius: 50%;">
                                <i class="{{ $category->icon }} fa-lg" style="color: {{ $category->color }};"></i>
                            </span>
                            <div>
                                <div class="mobile-category-name">{{ $category->name }}</div>
                                <div class="mobile-category-type text-success">Pemasukan</div>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-dark" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('categories.edit', $category->id) }}"><i class="fas fa-edit fa-fw me-2"></i>Edit</a></li>
                                <li><button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal" data-id="{{ $category->id }}" data-name="{{ $category->name }}"><i class="fas fa-trash-alt fa-fw me-2"></i>Hapus</button></li>
                            </ul>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-3">
                    <i class="fas fa-tags fa-2x text-muted mb-2"></i>
                    <p class="text-muted">Belum ada kategori pemasukan</p>
                </div>
                @endforelse

                <h4 class="text-danger mt-4 mb-3"><i class="fas fa-arrow-up me-2"></i>Pengeluaran</h4>
                @forelse($expenseCategories as $category)
                <div class="mobile-category-card">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="d-flex align-items-center">
                            <span class="d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; background-color: {{ $category->color }}20; border-radius: 50%;">
                                <i class="{{ $category->icon }} fa-lg" style="color: {{ $category->color }};"></i>
                            </span>
                            <div>
                                <div class="mobile-category-name">{{ $category->name }}</div>
                                <div class="mobile-category-type text-danger">Pengeluaran</div>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-dark" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('categories.edit', $category->id) }}"><i class="fas fa-edit fa-fw me-2"></i>Edit</a></li>
                                <li><button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal" data-id="{{ $category->id }}" data-name="{{ $category->name }}"><i class="fas fa-trash-alt fa-fw me-2"></i>Hapus</button></li>
                            </ul>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-3">
                    <i class="fas fa-tags fa-2x text-muted mb-2"></i>
                    <p class="text-muted">Belum ada kategori pengeluaran</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Floating Action Button untuk Mobile -->
<a href="{{ route('categories.create') }}" class="btn btn-primary btn-add-mobile d-md-none">
    <i class="fas fa-plus"></i>
</a>

<!-- Modal Hapus -->
<div class="modal fade" id="deleteCategoryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark-3">
            <div class="modal-header border-0">
                <h5 class="modal-title text-danger"><i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus kategori "<strong id="categoryName"></strong>"?</p>
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
    const deleteModal = document.getElementById('deleteCategoryModal');
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const categoryId = button.getAttribute('data-id');
            const categoryName = button.getAttribute('data-name');
            
            const form = deleteModal.querySelector('#deleteForm');
            form.action = '/categories/' + categoryId;
            
            const nameSpan = deleteModal.querySelector('#categoryName');
            nameSpan.textContent = categoryName;
        });
    }
});
</script>
@endpush