@extends('layouts.master')

@section('title', 'Product Confirmation')
@section('page_title', 'Product Confirmation')
@section('page_subtitle', 'The submitted product details are shown here after a successful save.')

@section('content')
    @if (session('status'))
        <div class="alert alert-success border-0 shadow-sm">
            {{ session('status') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Submitted Product</h5>
                    <a href="{{ route('products.create') }}" class="btn btn-sm btn-outline-primary">Create Another</a>
                </div>

                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Product ID</dt>
                        <dd class="col-sm-8">{{ $product->id }}</dd>

                        <dt class="col-sm-4">Category</dt>
                        <dd class="col-sm-8">{{ $product->category_name }}</dd>

                        <dt class="col-sm-4">Product Name</dt>
                        <dd class="col-sm-8">{{ $product->name }}</dd>

                        <dt class="col-sm-4">Price</dt>
                        <dd class="col-sm-8">${{ number_format((float) $product->price, 2) }}</dd>

                        <dt class="col-sm-4">Stock</dt>
                        <dd class="col-sm-8">{{ $product->stock }}</dd>
                    </dl>

                    <div class="d-flex gap-2 mt-4">
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-primary">Edit Product</a>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
