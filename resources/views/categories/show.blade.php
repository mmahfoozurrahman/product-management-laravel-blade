@extends('layouts.master')

@section('title', 'Category Details')
@section('page_title', 'Category Details')
@section('page_subtitle', 'See the category and the products assigned to it.')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            @if (session('status'))
                <div class="alert alert-success border-0 shadow-sm">
                    {{ session('status') }}
                </div>
            @endif

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 d-flex flex-wrap gap-2 justify-content-between align-items-center">
                    <h5 class="mb-0">{{ $category->name }}</h5>
                    <div class="d-inline-flex gap-2">
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete this category?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                        <a href="{{ route('categories.index') }}" class="btn btn-sm btn-outline-secondary">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-3">Category ID</dt>
                        <dd class="col-sm-9">{{ $category->id }}</dd>

                        <dt class="col-sm-3">Name</dt>
                        <dd class="col-sm-9">{{ $category->name }}</dd>

                        <dt class="col-sm-3">Products</dt>
                        <dd class="col-sm-9">{{ $category->products->count() }}</dd>
                    </dl>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0">Assigned Products</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th class="text-end">Price</th>
                                    <th class="text-end">Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($category->products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td class="fw-semibold">{{ $product->name }}</td>
                                        <td class="text-end">${{ number_format((float) $product->price, 2) }}</td>
                                        <td class="text-end">{{ $product->stock }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            No products assigned to this category yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
