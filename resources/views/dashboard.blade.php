@extends('layouts.app-dark')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Main Content -->
        <main class="col-lg-9 col-xl-10 ms-sm-auto px-md-4 py-4">
            <!-- Header -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <div>
                    <h1 class="h2 text-gradient">Dashboard</h1>
                    <p class="text-muted">Selamat datang kembali, {{ Auth::user()->name }}! ✨</p>
                </div>
            </div>

            <!-- Kartu Statistik -->
            <div class="row g-4 mb-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card bg-dark-2 h-100 p-3">
                        <div class="d-flex align-items-center">
                            <div class="fs-2 text-success me-3"><i class="fas fa-check-double"></i></div>
                            <div>
                                <h6 class="text-muted mb-1">Selesai Hari Ini</h6>
                                <h4 class="mb-0">{{ $completedToday }} Kebiasaan</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card bg-dark-2 h-100 p-3">
                        <div class="d-flex align-items-center">
                            <div class="fs-2 text-warning me-3"><i class="fas fa-tasks"></i></div>
                            <div>
                                <h6 class="text-muted mb-1">Total Aktif</h6>
                                <h4 class="mb-0">{{ $totalHabits }} Kebiasaan</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card bg-dark-2 h-100 p-3">
                        <div class="d-flex align-items-center">
                            <div class="fs-2 text-info me-3"><i class="fas fa-arrow-up"></i></div>
                            <div>
                                <h6 class="text-muted mb-1">Pemasukan Bulan Ini</h6>
                                <h4 class="mb-0">Rp {{ number_format($monthlyIncome, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card bg-dark-2 h-100 p-3">
                        <div class="d-flex align-items-center">
                            <div class="fs-2 text-danger me-3"><i class="fas fa-arrow-down"></i></div>
                            <div>
                                <h6 class="text-muted mb-1">Pengeluaran Bulan Ini</h6>
                                <h4 class="mb-0">Rp {{ number_format($monthlyExpense, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <!-- Kebiasaan Hari Ini & Transaksi Terakhir -->
                <div class="col-lg-7">
                    <div class="card bg-dark-2 mb-4">
                        <div class="card-header bg-dark-3 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-clipboard-list me-2"></i>Kebiasaan Hari Ini</h5>
                            <a href="{{ route('habits.index') }}" class="btn btn-sm btn-outline-secondary">Lihat Semua</a>
                        </div>
                        <div class="list-group list-group-flush">
                            @forelse($activeHabits as $habit)
                                <div class="list-group-item bg-dark-2 d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="{{ $habit->icon }} me-2" style="color: {{ $habit->color }};"></i>
                                        {{ $habit->name }}
                                    </div>
                                    <form action="{{ route('habits.toggle', $habit) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm {{ $habit->logs->contains('date', today()->toDateString()) ? 'btn-success' : 'btn-outline-secondary' }}">
                                            <i class="fas fa-{{ $habit->logs->contains('date', today()->toDateString()) ? 'check' : 'plus' }}"></i>
                                        </button>
                                    </form>
                                </div>
                            @empty
                                <div class="list-group-item bg-dark-2 text-center text-muted py-4">
                                    Tidak ada kebiasaan aktif.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="card bg-dark-2">
                        <div class="card-header bg-dark-3">
                            <h5 class="mb-0"><i class="fas fa-history me-2"></i>Transaksi Terakhir</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-dark table-hover mb-0">
                                <tbody>
                                @forelse($recentTransactions as $transaction)
                                    <tr>
                                        <td>
                                            <i class="{{ $transaction->category->icon ?? 'fas fa-question-circle' }} me-2"></i>
                                            {{ $transaction->description }}
                                        </td>
                                        <td class="text-{{ $transaction->type == 'income' ? 'success' : 'danger' }}">
                                            {{ $transaction->type == 'income' ? '+' : '-' }} Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                        </td>
                                        <td class="text-end text-muted">{{ $transaction->date->format('d M') }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center text-muted py-4">Belum ada transaksi.</td></tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Grafik Progres -->
                <div class="col-lg-5">
                    <div class="card bg-dark-2 h-100">
                        <div class="card-header bg-dark-3">
                            <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Progres Mingguan</h5>
                        </div>
                        <div class="card-body d-flex align-items-center">
                            <canvas id="habitChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('habitChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($habitChartLabels),
            datasets: [{
                label: 'Kebiasaan Selesai',
                data: @json($habitChartData),
                backgroundColor: 'rgba(108, 92, 231, 0.6)',
                borderColor: 'rgba(108, 92, 231, 1)',
                borderWidth: 1,
                borderRadius: 5,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: 'rgba(255, 255, 255, 0.7)',
                        stepSize: 1
                    },
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    }
                },
                x: {
                    ticks: {
                        color: 'rgba(255, 255, 255, 0.7)'
                    },
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
});
</script>
@endpush
