@extends('layouts.master')

@section('title', 'Category Confirmation')
@section('page_title', 'Category Confirmation')
@section('page_subtitle', 'The newly created category is shown here after a successful save.')

@section('content')
    @if (session('status'))
        <div class="alert alert-success border-0 shadow-sm">
            {{ session('status') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-12 col-lg-7">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Submitted Category</h5>
                    <a href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-primary">Create Another</a>
                </div>

                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Category ID</dt>
                        <dd class="col-sm-8">{{ $category->id }}</dd>

                        <dt class="col-sm-4">Category Name</dt>
                        <dd class="col-sm-8">{{ $category->name }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection
