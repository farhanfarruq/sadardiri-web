{{-- resources/views/partials/sidebar.blade.php --}}
<div class="col-lg-3 col-xl-2 px-0 sidebar" id="sidebar">
    <!-- Close button untuk mobile -->
    <div class="d-lg-none p-3 border-bottom border-secondary">
        <button class="btn btn-outline-secondary btn-sm float-end" id="sidebarClose">
            <i class="fas fa-times"></i>
        </button>
        <div class="clearfix"></div>
    </div>
    
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarClose = document.getElementById('sidebarClose');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        
        // Close sidebar button
        if (sidebarClose) {
            sidebarClose.addEventListener('click', function() {
                sidebar.classList.remove('show');
                if (sidebarOverlay) {
                    sidebarOverlay.classList.remove('show');
                }
            });
        }
        
        // Close sidebar when clicking nav link on mobile
        const navLinks = sidebar.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 991.98) {
                    setTimeout(() => {
                        sidebar.classList.remove('show');
                        if (sidebarOverlay) {
                            sidebarOverlay.classList.remove('show');
                        }
                    }, 150);
                }
            });
        });
    });
</script>