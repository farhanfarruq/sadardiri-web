@extends('layouts.app-dark')

@section('title', 'Manajemen Kategori')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('partials.sidebar')
        
        <div class="col-lg-9 col-xl-10 ms-sm-auto px-md-4 py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h2 text-gradient"><i class="fas fa-tags me-2"></i>Manajemen Kategori</h1>
                <a href="{{ route('categories.create') }}" class="btn btn-primary rounded-pill">
                    <i class="fas fa-plus me-2"></i>Tambah Kategori
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
            @endif

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
                                {{-- PERBAIKAN DI SINI --}}
                                <span class="fw-bold text-light">{{ $category->name }}</span>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-dark" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('categories.edit', $category->id) }}"><i class="fas fa-edit fa-fw me-2"></i>Edit</a></li>
                                    <li><button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal" data-id="{{ $category->id }}" data-name="{{ $category->name }}"><i class="fas fa-trash-alt fa-fw me-2"></i>Hapus</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-muted">Belum ada kategori pemasukan.</p>
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
                                {{-- PERBAIKAN DI SINI --}}
                                <span class="fw-bold text-light">{{ $category->name }}</span>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-dark" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('categories.edit', $category->id) }}"><i class="fas fa-edit fa-fw me-2"></i>Edit</a></li>
                                    <li><button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal" data-id="{{ $category->id }}" data-name="{{ $category->name }}"><i class="fas fa-trash-alt fa-fw me-2"></i>Hapus</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-muted">Belum ada kategori pengeluaran.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="deleteCategoryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark-3">
            <div class="modal-header border-0">
                <h5 class="modal-title text-danger">Konfirmasi Hapus</h5>
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
