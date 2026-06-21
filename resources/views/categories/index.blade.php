@extends('layouts.master')

@section('title', 'Categories')
@section('page_title', 'Categories')
@section('page_subtitle', 'Manage product categories and keep the assignment structure organized.')

@section('content')
    @if (session('status'))
        <div class="alert alert-success border-0 shadow-sm">
            {{ session('status') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2">
            <div>
                <h5 class="mb-1">All Categories</h5>
                <small class="text-muted">Add, update, view, or remove categories from one place.</small>
            </div>
            <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm">Add Category</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th class="text-end">Products</th>
                            <th class="text-end"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td class="fw-semibold">{{ $category->name }}</td>
                                <td class="text-end">{{ $category->products_count }}</td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-2">
                                        <a href="{{ route('categories.show', $category->id) }}" class="btn btn-sm btn-dark">Details</a>
                                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete this category?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-5">
                                    No categories created yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
