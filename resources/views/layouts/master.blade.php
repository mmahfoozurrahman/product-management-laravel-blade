<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name'))</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --app-sidebar: #0f172a;
            --app-sidebar-accent: #1e293b;
            --app-surface: #f8fafc;
            --app-border: #e2e8f0;
            --app-text: #0f172a;
        }

        body {
            font-family: 'Inter', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(37, 99, 235, 0.10), transparent 28%),
                linear-gradient(180deg, #f8fafc 0%, #eef2ff 100%);
            color: var(--app-text);
        }

        .app-shell {
            min-height: 100vh;
        }

        .app-sidebar {
            width: 280px;
            background: linear-gradient(180deg, var(--app-sidebar) 0%, #111827 100%);
            color: #fff;
        }

        .app-sidebar .nav-link {
            color: rgba(255, 255, 255, 0.78);
            border-radius: 0.75rem;
            padding: 0.8rem 1rem;
        }

        .app-sidebar .nav-link:hover,
        .app-sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.10);
            color: #fff;
        }

        .app-content {
            background: rgba(248, 250, 252, 0.78);
            backdrop-filter: blur(8px);
        }

        .stat-card {
            border-radius: 1rem;
        }

        .stat-icon {
            width: 3rem;
            height: 3rem;
            border-radius: 0.9rem;
            display: grid;
            place-items: center;
            font-size: 1.25rem;
        }

        .page-title {
            letter-spacing: -0.03em;
        }
    </style>

    @stack('styles')
</head>
<body>
    <div class="app-shell d-flex flex-column flex-lg-row">
        @include('partials.navbar')

        <div class="flex-grow-1 app-content">
            @include('partials.header')

            <main class="container-fluid py-4 px-3 px-lg-4">
                @yield('content')
            </main>

            @include('partials.footer')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
