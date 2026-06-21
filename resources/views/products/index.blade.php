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
                <small class="text-muted">Ready for Eloquent data and later CRUD work.</small>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('products.summary') }}" class="btn btn-outline-secondary btn-sm">Module Summary</a>
                <a href="{{ route('products.json') }}" class="btn btn-outline-primary btn-sm">JSON Response</a>
            </div>
        </div>

        <div class="card-body">
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
                                <td>{{ $product->category?->name ?? 'Uncategorized' }}</td>
                                <td class="text-end">${{ number_format((float) $product->price, 2) }}</td>
                                <td class="text-end">{{ $product->stock }}</td>
                                <td class="text-end">
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-dark">
                                        Details
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">
                                    No products available yet. The controller is ready for Step 5 data entry.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
