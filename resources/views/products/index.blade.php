@extends('layouts.master')

@section('title', 'Product List')
@section('page_title', 'Product List')
@section('page_subtitle', 'A simple view response for the product management module.')

@section('content')
    @if (session('status'))
        <div class="alert alert-success border-0 shadow-sm">
            {{ session('status') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2">
            <div>
                <h5 class="mb-1">All Products</h5>
                <small class="text-muted">Query builder list with search and price sorting.</small>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">Add Product</a>
                <a href="{{ route('products.summary') }}" class="btn btn-outline-secondary btn-sm">Module Summary</a>
                <a href="{{ route('products.json') }}" class="btn btn-outline-primary btn-sm">JSON Response</a>
            </div>
        </div>

        <div class="card-body">
            <div class="row g-3 mb-4">
                <div class="col-12 col-lg-8">
                    <form action="{{ route('products.index') }}" method="GET" class="row g-2">
                        <div class="col-12 col-md-7">
                            <input
                                type="search"
                                name="search"
                                class="form-control"
                                placeholder="Search products by name"
                                value="{{ $search }}"
                            >
                        </div>
                        <div class="col-12 col-md-3">
                            <select name="sort" class="form-select">
                                <option value="latest" @selected($sort === 'latest')>Latest first</option>
                                <option value="price_asc" @selected($sort === 'price_asc')>Price low to high</option>
                                <option value="price_desc" @selected($sort === 'price_desc')>Price high to low</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-2 d-grid">
                            <button type="submit" class="btn btn-dark">Filter</button>
                        </div>
                    </form>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="d-flex flex-wrap gap-2 justify-content-lg-end">
                        <span class="badge text-bg-light border">Total Products: {{ $productCount }}</span>
                        <span class="badge text-bg-light border">Shown: {{ $products->count() }}</span>
                        @if ($search !== '')
                            <a href="{{ route('products.index') }}" class="badge text-bg-secondary text-decoration-none">Clear Search</a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th class="text-end">Price</th>
                            <th class="text-end">Stock</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td class="fw-semibold">{{ $product->name }}</td>
                                <td>{{ $product->category_name ?? 'Uncategorized' }}</td>
                                <td class="text-end">${{ number_format((float) $product->price, 2) }}</td>
                                <td class="text-end">{{ $product->stock }}</td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-2">
                                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-dark">
                                            Details
                                        </a>
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-outline-primary">
                                            Edit
                                        </a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">
                                    No products match the current filter.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
