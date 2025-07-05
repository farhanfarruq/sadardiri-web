@extends('layouts.app-dark')

@section('title', 'Manajemen Keuangan')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('partials.sidebar')
        
        <div class="col-lg-9 col-xl-10 ms-sm-auto px-md-4 py-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                <h1 class="h2 text-gradient"><i class="fas fa-wallet me-2"></i>Riwayat Keuangan</h1>
                <a href="{{ route('transactions.create') }}" class="btn btn-primary btn-lg rounded-pill"><i class="fas fa-plus-circle me-2"></i>Tambah Transaksi</a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            <div class="card bg-dark-2 border-0 shadow-lg">
                <div class="card-body p-0">
                    {{-- PERBAIKAN: Menghapus .table-responsive dari sini --}}
                    <table class="table table-dark table-hover mb-0">
                        <thead>
                            <tr class="text-uppercase small">
                                <th class="py-3 ps-4">Tanggal</th>
                                <th>Deskripsi</th>
                                <th>Kategori</th>
                                <th class="text-end">Jumlah</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $transaction)
                            <tr class="align-middle">
                                <td class="py-3 ps-4">{{ $transaction->date->format('d M Y') }}</td>
                                <td><a href="{{ route('transactions.show', $transaction->id) }}" class="text-white text-decoration-none">{{ $transaction->description }}</a></td>
                                <td>
                                    @if($transaction->category)
                                        <span class="badge" style="background-color: {{ $transaction->category->color }}20; color: {{ $transaction->category->color }};"><i class="{{ $transaction->category->icon }} fa-fw"></i> {{ $transaction->category->name }}</span>
                                    @else
                                        <span class="badge bg-secondary">Tanpa Kategori</span>
                                    @endif
                                </td>
                                <td class="text-end fw-bold {{ $transaction->type == 'income' ? 'text-success' : 'text-danger' }}">
                                    {{ $transaction->type == 'income' ? '+' : '-' }} Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                </td>
                                <td class="text-center">
                                    {{-- Biarkan dropdown seperti ini, Bootstrap akan menanganinya --}}
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-dark" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                                            <li><a class="dropdown-item" href="{{ route('transactions.show', $transaction->id) }}"><i class="fas fa-eye fa-fw me-2"></i>Detail</a></li>
                                            <li><a class="dropdown-item" href="{{ route('transactions.edit', $transaction->id) }}"><i class="fas fa-edit fa-fw me-2"></i>Edit</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteTransactionModal" data-id="{{ $transaction->id }}" data-description="{{ $transaction->description }}"><i class="fas fa-trash-alt fa-fw me-2"></i>Hapus</button></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                                    <h4 class="text-muted">Belum Ada Transaksi</h4>
                                    <p class="text-muted">Mulai catat pemasukan dan pengeluaran Anda.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($transactions->hasPages())
                <div class="card-footer bg-dark-3 border-0 d-flex justify-content-center">
                    {{ $transactions->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="deleteTransactionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark-3">
            <div class="modal-header border-0">
                <h5 class="modal-title text-danger"><i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus transaksi "<strong id="transactionDescription"></strong>"?</p>
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
    const deleteModal = document.getElementById('deleteTransactionModal');
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const transactionId = button.getAttribute('data-id');
            const transactionDescription = button.getAttribute('data-description');
            
            const form = deleteModal.querySelector('#deleteForm');
            form.action = '/transactions/' + transactionId;
            
            const descriptionSpan = deleteModal.querySelector('#transactionDescription');
            descriptionSpan.textContent = transactionDescription;
        });
    }
});
</script>
@endpush
