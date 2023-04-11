@extends('admin.layouts.app-layout', ['title' => env('APP_NAME'), 'page' => 'Date Create'])
@push('styles')
    <link rel="stylesheet" href="{{ asset('cp/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cp/assets/css/lms/custom.css?v='.time()) }}">
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Courses</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Date</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="card-title mb-0 mt-2 lh-lg"> avilable Date Create</h6>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.products.avilabledatestore') }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="start_at"    class="form-label">Start Date<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="hidden" name="product_id" value="{{$product_id}}">
                                <input type="text" class="form-control date-time" id="start_at"  name="avilable_dates[]" placeholder="Avilable Date" value="{{ old('avilable_dates') }}" readonly="readonly">
                                {{--  <span class="input-group-text input-group-addon" data-toggle=""><i data-feather="calendar"></i></span>  --}}
                                <button id="rowAdder" type="button"
                                    class="btn btn-dark">
                                    <span class="bi bi-plus-square-dotted">
                                    </span> ADD
                                </button>
                            </div>
                        </div>
                        <div id="newinput"></div>
                        <div class="mb-3">
                            <label for="end_at" class="form-label">End Date<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control date-time" id="end_at" name="end_at" placeholder="End Date" value="{{ old('end_at') }}" readonly="readonly" disabled>
                                <input class="form-control-input me-1" type="checkbox" id="date_valid" name="date_valid"/>
                                {{--  <span class="input-group-text input-group-addon" data-toggle=""><i data-feather="calendar"></i></span>  --}}
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                        <button type="reset" class="btn btn-secondary">Clear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <h6>Next Courses Avilable Dates</h6>
                @foreach ($products as $product)
                    <div>{{ $product->start_at }}</div>
                @endforeach
                <div></div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="{{ asset('cp/assets/vendors/tinymce/tinymce.min.js?v='.time()) }}"></script>
<script src="{{ asset('cp/assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('cp/assets/js/lms/products.js?v='.time()) }}"></script>
<script src="{{ asset('cp/assets/js/lms/custom.js?v='.time()) }}"></script>
@endpush
