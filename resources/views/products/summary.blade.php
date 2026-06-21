@extends('layouts.master')

@section('title', 'Product Module Summary')
@section('page_title', 'Product Module Summary')
@section('page_subtitle', 'A small bridge page that will help when we add create and redirect flows later.')

@section('content')
    <div class="row g-4">
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted text-uppercase small mb-2">Categories</p>
                    <h2 class="mb-0">{{ $categoryCount }}</h2>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted text-uppercase small mb-2">Products</p>
                    <h2 class="mb-0">{{ $productCount }}</h2>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted text-uppercase small mb-2">Latest Product</p>
                    <h5 class="mb-1">{{ $latestProduct?->name ?? 'No product yet' }}</h5>
                    <p class="text-muted mb-0">
                        {{ $latestProduct?->category?->name ?? 'Waiting for data' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
