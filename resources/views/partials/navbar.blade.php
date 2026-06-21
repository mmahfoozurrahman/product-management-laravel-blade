<aside class="app-sidebar d-flex flex-column p-3 p-lg-4">
    <a href="{{ url('/') }}" class="d-flex align-items-center gap-2 text-white text-decoration-none mb-4">
        <div>
            <div class="fw-bold">{{ config('app.name') }}</div>
            <small class="text-white-50">Product Management</small>
        </div>
    </a>

    <nav class="nav flex-column gap-1">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard*') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i>
            Dashboard
        </a>
        <a href="{{ route('categories.index') }}"
            class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
            <i class="bi bi-diagram-3 me-2"></i>
            Categories
        </a>
        <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
            <i class="bi bi-box-seam me-2"></i>
            Products
        </a>
    </nav>
</aside>