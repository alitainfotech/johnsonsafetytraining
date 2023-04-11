@extends('admin.layouts.app-layout', ['title' => env('APP_NAME'), 'page' => 'Category Edit'])
{{-- @push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/ams/custom.css?v='.time()) }}">
@endpush --}}
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categories</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="card-title mb-0 mt-2 lh-lg">Category Edit</h6>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="forms-sample">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" autocomplete="off" placeholder="Name" value="{{ old('name', $category->name) }}">
                            <p class="mt-1 tx-13 text-danger">{{ $errors->first('name') }}</p>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- @push('scripts')
    <script src="{{ asset('assets/js/ams/categories.js?v='.time()) }}"></script>
@endpush --}}