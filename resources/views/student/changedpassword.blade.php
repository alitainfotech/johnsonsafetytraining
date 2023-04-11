@extends('admin.layouts.app-layout', ['title' => env('APP_NAME'), 'page' => 'Changed Password'])
@push('styles')
    <link rel="stylesheet" href="{{ asset('cp/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cp/assets/css/lms/custom.css?v='.time()) }}">
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            {{--  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>  --}}
            <li class="breadcrumb-item active" aria-current="page">Changed password</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="card-title mb-0 mt-2 lh-lg">Changed Password</h6>
                        </div>
                        {{--  <div class="col-md-6 text-end">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Back</a>
                        </div>  --}}
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('student.changepassword.store') }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" autocomplete="off" placeholder="current password" value="{{ old('current_password') }}">
                            <p class="mt-1 tx-13 text-danger">{{ $errors->first('current_password') }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" autocomplete="off" placeholder="new password" value="{{ old('current_password') }}">
                            <p class="mt-1 tx-13 text-danger">{{ $errors->first('new_password') }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="new_confirm_password" name="new_confirm_password" autocomplete="off" placeholder="new confirm password" value="{{ old('new_confirm_password') }}">
                            <p class="mt-1 tx-13 text-danger">{{ $errors->first('new_confirm_password') }}</p>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
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
<script src="{{ asset('cp/assets/js/lms/custom.js?v='.time()) }}"></script>
@endpush
