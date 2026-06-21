@extends('layouts.master')

@section('title', 'Edit Category')
@section('page_title', 'Edit Category')
@section('page_subtitle', 'Update the category name while keeping the product assignments intact.')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-lg-7">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0">Edit Category</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('categories.update', $category->id) }}" method="POST" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Category Name</label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $category->name) }}"
                            >
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-outline-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
