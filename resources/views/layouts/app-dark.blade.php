<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sadar Diri')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #6c5ce7;
            --primary-hover: #5649c0;
            --success-color: #00b894;
            --warning-color: #fdcb6e;
            --danger-color: #d63031;
            --dark-color: #0f0f13;
            --dark-2: #1a1a24;
            --dark-3: #252532;
            --text-bright: #e5e7eb;
            --text-muted: #b5b5c0;
        }
        
        body {
            background-color: var(--dark-color);
            font-family: 'Poppins', sans-serif;
            color: var(--text-bright);
        }

        h1, h2, h3, h4, h5, h6, a {
            color: var(--text-bright);
        }
        a:hover {
            color: var(--primary-color);
        }

        .navbar {
            background-color: var(--dark-2);
            border-bottom: 1px solid var(--dark-3);
        }
        
        .bg-dark-2 { background-color: var(--dark-2) !important; }
        .bg-dark-3 { background-color: var(--dark-3) !important; }
        
        .text-gradient {
            background: linear-gradient(45deg, var(--primary-color), #a29bfe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .card {
            border: none;
            border-radius: 12px;
            background-color: var(--dark-2);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        .form-control, .form-select {
            background-color: var(--dark-3);
            border: 1px solid var(--dark-3);
            color: var(--text-bright);
        }

        /* --- PERBAIKAN UNTUK DROPDOWN --- */
        .form-select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23b5b5c0' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
        }
        .form-select:focus {
            background-color: var(--dark-3);
            color: var(--text-bright);
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(108, 92, 231, 0.25);
        }
        
        .nav-link {
            color: var(--text-muted);
        }
        
        .nav-link:hover, .nav-link.active {
            color: var(--text-bright);
            background-color: rgba(108, 92, 231, 0.1);
        }
        
        .nav-link.active {
            color: var(--primary-color);
            font-weight: 500;
        }
        
        /* Sidebar Responsif */
        .sidebar {
            height: 100vh;
            position: sticky;
            top: 0;
            background: var(--dark-2);
            border-right: 1px solid rgba(255, 255, 255, 0.05);
            transition: transform 0.3s ease;
        }
        
        /* Hamburger Menu Button */
        .hamburger-btn {
            display: none;
            background: none;
            border: none;
            color: var(--text-bright);
            font-size: 1.5rem;
            cursor: pointer;
        }
        
        .hamburger-btn:hover {
            color: var(--primary-color);
        }
        
        /* Sidebar Overlay untuk mobile */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 998;
            display: none;
        }
        
        /* Responsive Breakpoints */
        @media (max-width: 991.98px) {
            .hamburger-btn {
                display: block;
            }
            
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                z-index: 999;
                width: 280px;
                height: 100vh;
                transform: translateX(-100%);
                padding-top: 80px; /* Space for navbar */
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .sidebar-overlay.show {
                display: block;
            }
            
            .main-content {
                margin-left: 0 !important;
                width: 100% !important;
            }
        }
        
        @media (min-width: 992px) {
            .sidebar {
                transform: translateX(0);
                position: sticky;
            }
        }
        
        .text-muted, p.text-muted, span.small.text-muted, .card-header, .form-label {
            color: var(--text-muted) !important;
        }

        /* Target semua teks dalam list-group-item, khususnya untuk kebiasaan */
        .list-group-item.bg-dark-2 div {
            color: var(--text-bright) !important;
            opacity: 1 !important;
            font-weight: 500;
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow-sm">
        <div class="container-fluid">
            <!-- Hamburger Menu Button -->
            <button class="hamburger-btn me-3" type="button" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <span class="d-flex align-items-center">
                    <span class="logo-container me-2 position-relative" style="font-size: 1.8rem;">
                        <i class="fas fa-chart-line" style="color: #6c5ce7; filter: drop-shadow(0 2px 4px rgba(108, 92, 231, 0.3));"></i>
                        <i class="fas fa-circle" style="color: #00b894; font-size: 0.4rem; position: absolute; top: 2px; right: 2px;"></i>
                    </span>
                    <span class="text-gradient fw-bold fs-4">Sadar Diri</span>
                </span>
            </a>
            <div class="ms-auto">
                @auth
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle me-2"></i>
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('settings.index') }}">
                                <i class="fas fa-cog fa-fw me-2"></i>Pengaturan
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt fa-fw me-2"></i>Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    @yield('content')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Sidebar Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.querySelector('.sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            
            // Toggle sidebar
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('show');
                sidebarOverlay.classList.toggle('show');
            });
            
            // Close sidebar when clicking overlay
            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.remove('show');
                sidebarOverlay.classList.remove('show');
            });
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 991.98) {
                    if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                        sidebar.classList.remove('show');
                        sidebarOverlay.classList.remove('show');
                    }
                }
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 991.98) {
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>