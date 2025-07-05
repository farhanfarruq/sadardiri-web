{{-- resources/views/partials/sidebar.blade.php --}}
<div class="col-lg-3 col-xl-2 px-0 sidebar">
    <nav class="nav flex-column pt-3">
        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <i class="fas fa-home me-2"></i>Dashboard
        </a>
        <a class="nav-link {{ request()->routeIs('habits.*') ? 'active' : '' }}" href="{{ route('habits.index') }}">
            <i class="fas fa-check-circle me-2"></i>Kebiasaan
        </a>
        <a class="nav-link" href="#">
            <i class="fas fa-wallet me-2"></i>Keuangan
        </a>
        <a class="nav-link" href="#">
            <i class="fas fa-tags me-2"></i>Kategori
        </a>
        <a class="nav-link" href="#">
            <i class="fas fa-piggy-bank me-2"></i>Target Tabungan
        </a>
        <a class="nav-link" href="#">
            <i class="fas fa-chart-bar me-2"></i>Laporan
        </a>
    </nav>
</div>
