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
            --light-color: #f8f9fa;
            --text-muted: #8a8a9a;
        }
        
        body {
            background-color: var(--dark-color);
            font-family: 'Poppins', sans-serif;
            color: var(--light-color);
        }
        
        .bg-dark-2 {
            background-color: var(--dark-2) !important;
        }
        
        .bg-dark-3 {
            background-color: var(--dark-3) !important;
        }
        
        .text-gradient {
            background: linear-gradient(45deg, var(--primary-color), #a29bfe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color) !important;
            letter-spacing: 1px;
        }
        
        .card {
            border: none;
            border-radius: 12px;
            background-color: var(--dark-2);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 92, 231, 0.3);
        }
        
        .form-control {
            background-color: var(--dark-3);
            border: 1px solid var(--dark-3);
            color: var(--light-color);
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            background-color: var(--dark-3);
            color: var(--light-color);
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(108, 92, 231, 0.25);
        }
        
        .nav-link {
            color: var(--text-muted);
            transition: all 0.3s ease;
            border-radius: 8px;
            padding: 10px 15px;
            margin: 5px 0;
        }
        
        .nav-link:hover, .nav-link.active {
            color: var(--light-color);
            background-color: rgba(108, 92, 231, 0.1);
        }
        
        .nav-link.active {
            color: var(--primary-color);
            font-weight: 500;
        }
        
        .sidebar {
            min-height: calc(100vh - 70px);
            background: var(--dark-2);
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .text-muted {
            color: var(--text-muted) !important;
        }
        
        .border-bottom {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: var(--dark-2);
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 10px;
        }
        
        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade {
            animation: fadeIn 0.5s ease forwards;
        }
    </style>
    
    @yield('styles')
</head>
<body>
    @yield('content')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // CSRF token for AJAX requests
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    </script>
    
    @yield('scripts')
</body>
</html>