@extends('admin.layouts.app-layout', ['title' => env('APP_NAME'), 'page' => 'Product Show'])
@push('styles')
<link rel="stylesheet" href="{{ asset('cp/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
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
                            <h6 class="card-title mb-0 mt-2 lh-lg">Material Show</h6>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{ route('admin.products.index') }}" type="button" class="btn btn-primary">
                                Back
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.products.addmaterial',$product->id) }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <input id="product_id" name="product_id" type="hidden" value="">
                            <label for="materials" class="form-label">Add Materials</label>
                            <input type="file" class="form-control" id="materials" name="materials[]" autocomplete="off" multiple="multiple" required>
                            <p class="mt-1 tx-13 text-danger">{{ $errors->first('materials') }}</p>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                        <button type="reset" class="btn btn-secondary">Clear</button>
                    </form>
                </br>
                </br>
                    <div class="row">
                        @foreach ($product->materials as $material)
                        <div class="col-md-3 product-wrapper mb-3">
                            <iframe width="100%" src="{{$material->file_name}}"></iframe>
                            <a href="{{$material->file_name}}" target="_blank"><button class="btn btn-primary">view file</button></a>
                            <button data-id="{{ $material->id }}"
                                data-route="{{ route('admin.products.deletematerial',$material) }}"
                                type="button" class="product-image-button btn btn-xs btn-danger btn-icon">
                                <i data-feather="trash"></i>
                            </button>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="{{ asset('cp/assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('cp/assets/js/lms/products.js?v='.time()) }}"></script>
<script src="{{ asset('cp/assets/js/lms/custom.js?v='.time()) }}"></script>
@endpush
