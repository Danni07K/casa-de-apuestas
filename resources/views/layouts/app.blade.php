<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TecBet') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            color: white;
            background: #000000;
        }

        .navbar {
            background: rgba(0, 0, 0, 0.75);
            border-bottom: 1px solid rgba(47, 211, 93, 0.3);
            padding: 1rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
        }

        .navbar-brand {
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            color: #2FD35D !important;
            font-size: 1.5rem;
            text-shadow: 0 0 20px rgba(47, 211, 93, 0.3);
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: #2FD35D !important;
        }

        .navbar .btn-login {
            background: transparent;
            border: 1px solid #2FD35D;
            color: #2FD35D;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .navbar .btn-login:hover {
            background: #2FD35D;
            color: white;
        }

        .navbar .btn-register {
            background: #2FD35D;
            border: none;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            transition: all 0.3s ease;
            margin-left: 1rem;
            text-decoration: none;
        }

        .navbar .btn-register:hover {
            background: #28b850;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(47, 211, 93, 0.3);
            color: white;
        }

        .user-menu {
            color: white;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .btn-logout {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.4);
        }

        main {
            padding-top: 76px; /* Altura del navbar */
            min-height: calc(100vh - 76px);
            width: 100%;
            overflow-x: hidden;
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 0.5rem 0;
            }

            .navbar-collapse {
                background: rgba(0, 0, 0, 0.95);
                padding: 1rem;
                border-radius: 0 0 15px 15px;
            }

            .navbar .btn-login,
            .navbar .btn-register {
                display: block;
                margin: 0.5rem 0;
                text-align: center;
            }

            .user-menu {
                flex-direction: column;
                align-items: stretch;
            }
        }
    </style>

    <!-- Page Specific Styles -->
    @yield('styles')
</head>
<body>
    <!-- Include Header -->
    @include('layouts.header')

    <main>
        @yield('content')
    </main>

    <!-- Include Footer -->
    @include('layouts.footer')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script>AOS.init();</script>
    @stack('scripts')
</body>
</html> 