{{-- resources/views/partials/sidebar.blade.php --}}
<div class="col-lg-3 col-xl-2 px-0 sidebar">
    <nav class="nav flex-column pt-3">
        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <i class="fas fa-home fa-fw me-2"></i>Dashboard
        </a>
        <a class="nav-link {{ request()->routeIs('habits.*') ? 'active' : '' }}" href="{{ route('habits.index') }}">
            <i class="fas fa-check-circle fa-fw me-2"></i>Kebiasaan
        </a>
        <a class="nav-link {{ request()->routeIs('transactions.*') ? 'active' : '' }}" href="{{ route('transactions.index') }}">
            <i class="fas fa-wallet fa-fw me-2"></i>Keuangan
        </a>
        <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
            <i class="fas fa-tags fa-fw me-2"></i>Kategori
        </a>
        <a class="nav-link {{ request()->routeIs('savings-targets.*') ? 'active' : '' }}" href="{{ route('savings-targets.index') }}">
            <i class="fas fa-piggy-bank fa-fw me-2"></i>Target Tabungan
        </a>
        <a class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}" href="{{ route('reports.index') }}">
            <i class="fas fa-chart-bar fa-fw me-2"></i>Laporan
        </a>
        <a class="nav-link {{ request()->routeIs('settings.*') ? 'active' : '' }}" href="{{ route('settings.index') }}">
            <i class="fas fa-cog fa-fw me-2"></i>Pengaturan
        </a>
    </nav>
</div>
