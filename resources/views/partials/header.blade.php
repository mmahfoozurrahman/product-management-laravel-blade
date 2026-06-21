<header class="border-bottom bg-white sticky-top">
    <div class="container-fluid py-3 px-3 px-lg-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2">
            <div>
                <p class="text-uppercase text-muted small mb-1">{{ config('app.name') }}</p>
                <h1 class="h3 page-title mb-0">@yield('page_title', 'Dashboard')</h1>
                <p class="text-muted mb-0">
                    @yield('page_subtitle', 'Reusable Blade layout for the product management workspace')</p>
            </div>
        </div>
    </div>
</header>