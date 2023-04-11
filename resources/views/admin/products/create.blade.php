@extends('admin.layouts.app-layout', ['title' => env('APP_NAME'), 'page' => 'Product Create'])
@push('styles')
    <link rel="stylesheet" href="{{ asset('cp/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cp/assets/css/lms/custom.css?v='.time()) }}">
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Courses</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="card-title mb-0 mt-2 lh-lg">Course Create</h6>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.products.store') }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" autocomplete="off" placeholder="Name" value="{{ old('name') }}">
                            <p class="mt-1 tx-13 text-danger">{{ $errors->first('name') }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                            <select name="category_id" id="category_id" class="form-select">
                                <option value="0">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id  ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <p class="mt-1 tx-13 text-danger">{{ $errors->first('category_id') }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="suburb" class="form-label">Suburb <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="suburb" name="suburb" autocomplete="off" placeholder="Suburb" value="{{ old('suburb') }}">
                            <p class="mt-1 tx-13 text-danger">{{ $errors->first('suburb') }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="tag" class="form-label">Tag <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="tag" name="tag" autocomplete="off" placeholder="Tag" value="{{ old('tag') }}">
                            <p class="mt-1 tx-13 text-danger">{{ $errors->first('tag') }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea type="text" class="form-control description" id="description" name="description" autocomplete="off" placeholder="Description">{{ old('description') }}</textarea>
                            <p class="mt-1 tx-13 text-danger">{{ $errors->first('description') }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                            <input type="text" class="form-control numberonly" id="price" name="price" autocomplete="off" placeholder="Price" value="{{ old('price') }}">
                            <p class="mt-1 tx-13 text-danger">{{ $errors->first('price') }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="start_at" class="form-label">Start Date<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control date-time" id="start_at" name="start_at" placeholder="Start Date" value="{{ old('start_at') }}" readonly="readonly">
                                {{--  <span class="input-group-text input-group-addon" data-toggle=""><i data-feather="calendar"></i></span>  --}}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="end_at" class="form-label">End Date<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control date-time" id="end_at" name="end_at" placeholder="End Date" value="{{ old('end_at') }}" readonly="readonly" disabled>
                                {{--  <span class="input-group-text input-group-addon" data-toggle=""><i data-feather="calendar"></i></span>  --}}
                                <input class="form-control-input me-1" type="checkbox" id="date_valid" name="date_valid"/>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="files" class="form-label">Images <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="files" name="files[]" autocomplete="off" multiple="multiple">
                            <p class="mt-1 tx-13 text-danger">{{ $errors->first('files') }}</p>
                            <p class="mt-1 tx-13 text-danger">{{ $errors->first('files.*') }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="materials" class="form-label">Materials</label>
                            <input type="file" class="form-control" id="materials" name="materials[]" autocomplete="off" multiple="multiple">
                            <p class="mt-1 tx-13 text-danger">{{ $errors->first('materials') }}</p>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                        <button type="reset" class="btn btn-secondary">Clear</button>
                    </form>
                </div>
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
