@extends('layouts.master')

@section('title', 'Dashboard')
@section('page_title', 'Product Management Dashboard')
@section('page_subtitle', 'A live ORM-driven overview of categories, products, and inventory.')

@section('content')
    <div class="row g-4 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <p class="text-muted text-uppercase small mb-1">Total Categories</p>
                            <h3 class="mb-0 fw-bold">{{ $categoryCount }}</h3>
                        </div>
                        <div class="stat-icon bg-primary-subtle text-primary">
                            <i class="bi bi-diagram-3"></i>
                        </div>
                    </div>
                    <p class="text-muted mb-0 small">Categories available for product assignment.</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <p class="text-muted text-uppercase small mb-1">Total Products</p>
                            <h3 class="mb-0 fw-bold">{{ $productCount }}</h3>
                        </div>
                        <div class="stat-icon bg-success-subtle text-success">
                            <i class="bi bi-box-seam"></i>
                        </div>
                    </div>
                    <p class="text-muted mb-0 small">All stored products across the system.</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <p class="text-muted text-uppercase small mb-1">Total Stock Quantity</p>
                            <h3 class="mb-0 fw-bold">{{ $totalStockQuantity }}</h3>
                        </div>
                        <div class="stat-icon bg-warning-subtle text-warning">
                            <i class="bi bi-stack"></i>
                        </div>
                    </div>
                    <p class="text-muted mb-0 small">Sum of all product stock values.</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <p class="text-muted text-uppercase small mb-1">Workspace</p>
                            <h3 class="mb-0 fw-bold">Live</h3>
                        </div>
                        <div class="stat-icon bg-dark-subtle text-dark">
                            <i class="bi bi-speedometer2"></i>
                        </div>
                    </div>
                    <p class="text-muted mb-0 small">ORM-backed dashboard overview.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12 col-lg-7">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="mb-0">Latest 5 Products</h5>
                        <small class="text-muted">Fetched with Eloquent ORM and eager loading.</small>
                    </div>
                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-secondary">View Products</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th class="text-end">Price</th>
                                    <th class="text-end">Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($latestProducts as $product)
                                    <tr>
                                        <td class="fw-semibold">{{ $product->name }}</td>
                                        <td>{{ $product->category?->name ?? 'Uncategorized' }}</td>
                                        <td class="text-end">${{ number_format((float) $product->price, 2) }}</td>
                                        <td class="text-end">{{ $product->stock }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            No products available yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-5">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0">Module Snapshot</h5>
                </div>

                <div class="card-body">
                    <div class="d-grid gap-3">
                        <a href="{{ route('categories.create') }}" class="btn btn-outline-primary">Create Category</a>
                        <a href="{{ route('products.create') }}" class="btn btn-outline-success">Create Product</a>
                        <a href="{{ route('products.summary') }}" class="btn btn-outline-dark">Module Summary</a>
                    </div>

                    <hr class="my-4">

                    <div class="alert alert-info mb-0">
                        Dashboard data is read directly from the database using ORM, so it stays in sync with your products and categories.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
