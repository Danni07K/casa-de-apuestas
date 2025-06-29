<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TecBet') }} - Panel de Administración</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" crossorigin="anonymous" />

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2FD35D;
            --primary-color-hover: #28b850;
            --dark-bg: #10141a;
            --secondary-bg: #1a1e23;
            --border-color: rgba(47, 211, 93, 0.15);
            --text-color: #ffffff;
            --text-muted-color: #9eaab7;
        }

        h1, h2, h3, h4, h5, h6,
        .h1, .h2, .h3, .h4, .h5, .h6 {
            color: var(--text-color);
            font-weight: 600;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--dark-bg);
            color: var(--text-color);
            font-size: 15px;
            min-height: 100vh;
        }

        /* Sidebar */
        .admin-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 260px;
            background: var(--secondary-bg);
            border-right: 1px solid var(--border-color);
            padding: 1.5rem 1rem;
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        .admin-logo {
            padding: 0 1rem 1.5rem 1rem;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid var(--border-color);
        }

        .admin-logo .logo-text {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 1.8rem;
        }

        .admin-logo .tec { color: var(--text-color); }
        .admin-logo .bet { color: var(--primary-color); }

        .nav-section-title {
            color: var(--text-muted-color);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            padding: 0 1rem;
            margin-bottom: 0.75rem;
        }

        .nav-link {
            color: var(--text-muted-color);
            padding: 0.8rem 1rem;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            transition: all 0.2s ease-in-out;
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        .nav-link:hover {
            color: var(--primary-color);
            background: rgba(47, 211, 93, 0.08);
        }
        
        .nav-link.active {
            color: white;
            background: var(--primary-color);
            box-shadow: 0 4px 15px rgba(47, 211, 93, 0.2);
        }

        .nav-link i {
            width: 22px;
            text-align: center;
            font-size: 1rem;
            transition: transform 0.2s ease;
        }
        
        .nav-link.active i {
            transform: scale(1.1);
        }

        /* Main Content */
        .admin-main {
            margin-left: 260px;
            padding: 2rem 2.5rem;
        }

        .admin-header {
            background: var(--secondary-bg);
            border: 1px solid var(--border-color);
            padding: 1rem 2.5rem;
            margin: -2rem -2.5rem 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 0 0 15px 15px;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-color);
            margin: 0;
        }

        .user-menu .dropdown-toggle {
            color: var(--text-color);
            text-decoration: none;
            font-weight: 500;
        }
        
        .user-menu .dropdown-toggle i {
            color: var(--primary-color);
        }

        .user-menu .dropdown-menu {
            background: var(--secondary-bg);
            border: 1px solid var(--border-color);
        }
        
        .user-menu .dropdown-item {
            color: var(--text-color);
        }

        .user-menu .dropdown-item:hover {
            background: var(--primary-color);
            color: white;
        }

        /* Cards */
        .card {
            background: var(--secondary-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 25px rgba(0,0,0,0.1);
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid var(--border-color);
            padding: 1.25rem;
            font-weight: 600;
            font-size: 1.1rem;
            color: var(--text-color);
        }

        .card-body {
            padding: 1.25rem;
        }

        .text-primary {
            color: var(--primary-color) !important;
        }

        .text-muted {
            color: var(--text-muted-color) !important;
        }

        /* Tables */
        .table {
            color: var(--text-color);
            border-color: var(--border-color);
        }

        .table > :not(caption) > * > * {
            padding: 1rem 1.25rem;
            vertical-align: middle;
        }
        
        .table th {
            color: var(--text-muted-color);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            border-bottom-width: 1px;
        }

        /* Forms */
        .form-label {
            font-weight: 500;
            color: var(--text-muted-color);
            margin-bottom: 0.5rem;
        }
        
        .form-control, .form-select {
            background: var(--dark-bg);
            border: 1px solid var(--border-color);
            color: var(--text-color);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            transition: all 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            background: var(--dark-bg);
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(47, 211, 93, 0.2);
            color: var(--text-color);
        }

        .form-control::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: var(--text-muted-color);
            opacity: 1; /* Firefox */
        }

        .form-control:-ms-input-placeholder { /* Internet Explorer 10-11 */
            color: var(--text-muted-color);
        }

        .form-control::-ms-input-placeholder { /* Microsoft Edge */
            color: var(--text-muted-color);
        }

        /* Buttons */
        .btn {
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }
        
        .btn-success, .btn-primary {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: #10141a;
        }

        .btn-success:hover, .btn-primary:hover {
            background: var(--primary-color-hover);
            border-color: var(--primary-color-hover);
            color: #10141a;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(47, 211, 93, 0.2);
        }
        
        .btn-secondary {
            background: var(--secondary-bg);
            border-color: var(--border-color);
            color: var(--text-color);
        }
        
        .btn-secondary:hover {
            background: #272c32;
            border-color: #444c56;
        }

        /* Alerts */
        .alert {
            border-radius: 8px;
            padding: 1.25rem;
        }
        
        .alert-success {
            background-color: rgba(47, 211, 93, 0.1);
            border: 1px solid rgba(47, 211, 93, 0.3);
            color: #55d97a;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }

            .admin-sidebar.show {
                transform: translateX(0);
            }

            .admin-main {
                margin-left: 0;
            }

            .toggle-sidebar {
                display: block !important;
            }
        }

        /* Oculta SVGs gigantes fuera de lugar (por ejemplo, overlays de extensiones o navegadores) */
        body > svg:not([width="24"]):not([height="24"]),
        body > svg[width="100%"],
        body > svg[height="100%"],
        body > svg[style*="position: fixed"],
        body > svg[style*="position: absolute"] {
            display: none !important;
            pointer-events: none !important;
            z-index: -1 !important;
            opacity: 0 !important;
        }
    </style>

    @yield('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="admin-sidebar">
        <div class="admin-logo">
            <span class="logo-text">
                <span class="tec">Tec</span><span class="bet">Bet</span>
            </span>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Principal</div>
            <nav class="nav flex-column">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-chart-line"></i> Dashboard
                </a>
            </nav>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Gestión de Apuestas</div>
            <nav class="nav flex-column">
                <a class="nav-link {{ request()->routeIs('admin.events.*') ? 'active' : '' }}" href="{{ route('admin.events.index') }}">
                    <i class="fas fa-futbol"></i> Eventos Deportivos
                </a>
                <a class="nav-link {{ request()->routeIs('admin.bet-types.*') ? 'active' : '' }}" href="{{ route('admin.bet-types.index') }}">
                    <i class="fas fa-list"></i> Tipos de Apuestas
                </a>
            </nav>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Finanzas</div>
            <nav class="nav flex-column">
                <a class="nav-link {{ request()->routeIs('admin.payment-methods.*') ? 'active' : '' }}" href="{{ route('admin.payment-methods.index') }}">
                    <i class="fas fa-credit-card"></i> Métodos de Pago
                </a>
                <a class="nav-link {{ request()->routeIs('admin.deposits.*') ? 'active' : '' }}" href="{{ route('admin.deposits.index') }}">
                    <i class="fas fa-money-bill-wave"></i> Depósitos
                </a>
            </nav>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Comunicación</div>
            <nav class="nav flex-column">
                <a class="nav-link {{ request()->routeIs('admin.announcements.*') ? 'active' : '' }}" href="{{ route('admin.announcements.index') }}">
                    <i class="fas fa-bullhorn"></i> Anuncios
                </a>
            </nav>
        </div>

        <div class="nav-section mt-auto">
            <nav class="nav flex-column">
                <a class="nav-link" href="{{ route('betting.index') }}" target="_blank">
                    <i class="fas fa-external-link-alt"></i> Ver Sitio
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link text-danger border-0 bg-transparent w-100 text-start">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </button>
                </form>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <main class="admin-main">
        <div class="admin-header">
            <button class="btn btn-link text-white d-none toggle-sidebar">
                <i class="fas fa-bars"></i>
            </button>
            <h1 class="page-title">@yield('title')</h1>
            <div class="header-actions">
                @yield('header-actions')
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle Sidebar on Mobile
        document.querySelector('.toggle-sidebar')?.addEventListener('click', function() {
            document.querySelector('.admin-sidebar').classList.toggle('show');
        });
    </script>
    @yield('scripts')
</body>
</html> 