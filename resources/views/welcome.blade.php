@extends('layouts.master')

@section('title', 'Dashboard')
@section('page_title', 'Product Management Dashboard')
@section('page_subtitle', 'A clean Blade layout scaffold for the upcoming product management modules.')

@section('content')
    @php
        $stats = [
            [
                'label' => 'Total Categories',
                'value' => 0,
                'note' => 'Ready for Step 7 statistics.',
                'icon' => 'bi bi-diagram-3',
                'accent' => 'primary',
            ],
            [
                'label' => 'Total Products',
                'value' => 0,
                'note' => 'Will populate once data is connected.',
                'icon' => 'bi bi-box-seam',
                'accent' => 'success',
            ],
            [
                'label' => 'Total Stock',
                'value' => 0,
                'note' => 'Placeholder for inventory tracking.',
                'icon' => 'bi bi-stack',
                'accent' => 'warning',
            ],
            [
                'label' => 'Layout Status',
                'value' => 'Ready',
                'note' => 'Master layout and partials are in place.',
                'icon' => 'bi bi-layout-text-window',
                'accent' => 'dark',
            ],
        ];
    @endphp

    <div class="row g-4 mb-4">
        @foreach ($stats as $stat)
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card stat-card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <p class="text-muted text-uppercase small mb-1">{{ $stat['label'] }}</p>
                                <h3 class="mb-0 fw-bold">{{ $stat['value'] }}</h3>
                            </div>
                            <div class="stat-icon bg-{{ $stat['accent'] }}-subtle text-{{ $stat['accent'] }}">
                                <i class="{{ $stat['icon'] }}"></i>
                            </div>
                        </div>
                        <p class="text-muted mb-0 small">{{ $stat['note'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row g-4">
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="mb-0">Workspace Overview</h5>
                        <small class="text-muted">Built with Blade partials and reusable sections.</small>
                    </div>
                    <span class="badge text-bg-light">{{ config('app.name') }}</span>
                </div>
                <div class="card-body">
                    <p class="mb-3">
                        This starter layout is designed to support the future Product Management workflow.
                        It already includes a header, sidebar navigation, and footer partial so the app can grow
                        without reworking the base structure.
                    </p>

                    <div class="alert alert-info mb-0">
                        Today is <strong>{{ now()->format('F j, Y') }}</strong> and the application name is
                        <strong>{{ config('app.name') }}</strong>.
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0">Blade Directives Used</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0">`@@extends` for the master layout</li>
                        <li class="list-group-item px-0">`@@section` for page-specific content</li>
                        <li class="list-group-item px-0">`@@yield` for layout placeholders</li>
                        <li class="list-group-item px-0">`@@include` for reusable partials</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
