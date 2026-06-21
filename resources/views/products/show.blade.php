@extends('layouts.master')

@section('title', 'Product Details')
@section('page_title', 'Product Details')
@section('page_subtitle', 'View response for a single product record.')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ $product->name }}</h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                        <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-secondary">Back to list</a>
                    </div>
                </div>

                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Product ID</dt>
                        <dd class="col-sm-8">{{ $product->id }}</dd>

                        <dt class="col-sm-4">Category</dt>
                        <dd class="col-sm-8">{{ $product->category_name ?? 'Uncategorized' }}</dd>

                        <dt class="col-sm-4">Price</dt>
                        <dd class="col-sm-8">${{ number_format((float) $product->price, 2) }}</dd>

                        <dt class="col-sm-4">Stock</dt>
                        <dd class="col-sm-8">{{ $product->stock }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection
