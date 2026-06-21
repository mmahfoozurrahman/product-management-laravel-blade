<aside class="app-sidebar d-flex flex-column p-3 p-lg-4">
    <a href="{{ url('/') }}" class="d-flex align-items-center gap-2 text-white text-decoration-none mb-4">
        <div class="rounded-3 bg-white text-dark d-grid" style="width: 2.5rem; height: 2.5rem; place-items: center;">
            <i class="bi bi-bag-check-fill"></i>
        </div>
        <div>
            <div class="fw-bold">{{ config('app.name') }}</div>
            <small class="text-white-50">Product Management</small>
        </div>
    </a>

    <nav class="nav flex-column gap-1">
        <a href="{{ url('/') }}" class="nav-link active">
            <i class="bi bi-speedometer2 me-2"></i>
            Dashboard
        </a>
        <a href="#" class="nav-link">
            <i class="bi bi-box-seam me-2"></i>
            Products
        </a>
        <a href="#" class="nav-link">
            <i class="bi bi-diagram-3 me-2"></i>
            Categories
        </a>
    </nav>

    <div class="mt-auto pt-4">
        <div class="rounded-4 p-3" style="background: rgba(255, 255, 255, 0.08);">
            <p class="text-white-50 small mb-1">Current environment</p>
            <div class="fw-semibold">{{ app()->environment() }}</div>
        </div>
    </div>
</aside>
