@extends('admin.layouts.app-layout', ['title' => env('APP_NAME'), 'page' => 'Product Show'])
@push('styles')
    <link rel="stylesheet" href="{{ asset('cp/assets/css/lms/custom.css?v='.time()) }}">
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Courses</a></li>
            <li class="breadcrumb-item active" aria-current="page">Show</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="card-title mb-0 mt-2 lh-lg">Course Show</h6>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{ route('admin.products.index') }}" type="button" class="btn btn-primary">
                                Back
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h5 class="mb-2">{{ $product->name }} ({{ $product->category->name }})</h5>
                        <p>{!! $product->description !!}</p>
                    </div>
                    <div class="row">
                        @foreach ($product->images as $image)
                            <div class="col-md-3 product-wrapper mb-3">
                                <img class="product-image" src="{{ $image->path }}" alt="{{ $product->slug }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
