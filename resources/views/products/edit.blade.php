@extends('layouts.master')

@section('title', 'Edit Product')
@section('page_title', 'Edit Product')
@section('page_subtitle', 'Update an existing product using the same query builder-backed module.')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0">Edit Product</h5>
                </div>

                <div class="card-body">
                    @if ($categories->isEmpty())
                        <div class="alert alert-warning border-0 shadow-sm">
                            No categories exist yet. Please create a category first.
                            <div class="mt-2">
                                <a href="{{ route('categories.create') }}" class="btn btn-sm btn-warning">Create Category</a>
                            </div>
                        </div>
                    @endif

                    @include('products._form', [
                        'product' => $product,
                        'categories' => $categories,
                        'formAction' => route('products.update', $product->id),
                        'httpMethod' => 'PUT',
                        'buttonText' => 'Update Product',
                        'cancelRoute' => route('products.show', $product->id),
                    ])
                </div>
            </div>
        </div>
    </div>
@endsection
