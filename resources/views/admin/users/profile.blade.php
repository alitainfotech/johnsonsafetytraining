@extends('admin.layouts.app-layout', ['title' => env('APP_NAME'), 'page' => 'Profile'])
@push('styles')
<link rel="stylesheet" href="{{ asset('cp/assets/css/lms/custom.css?v='.time()) }}">
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            @if (session()->has('message'))
                <div class="alert alert-{{ session()->get('type') }} alert-dismissible fade show" role="alert">
                    {{ session()->get('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="card-title mb-0 mt-2 lh-lg">Profile Edit</h6>
                        </div>
                    </div>
                    <hr />
                    <form action="{{ route('admin.users.profile.update') }}" method="POST" class="forms-sample">
                        @csrf
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="full_name" name="full_name" autocomplete="off" placeholder="Full Name" value="{{ $user->full_name }}">
                            <p class="mt-1 tx-13 text-danger">{{ $errors->first('full_name') }}</p>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="reset" class="btn btn-secondary">Clear</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="card-title mb-0 mt-2 lh-lg">Change Password</h6>
                        </div>
                    </div>
                    <hr />
                    <form action="{{ route('admin.users.password.update') }}" method="POST" class="forms-sample">
                        @csrf
                        <div class="mb-3">
                            <label for="c_password" class="form-label">Current Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="c_password" name="c_password" autocomplete="off" placeholder="Current Password">
                            <p class="mt-1 tx-13 text-danger">{{ $errors->first('c_password') }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="new_password" name="new_password" autocomplete="off" placeholder="New Password">
                            <p class="mt-1 tx-13 text-danger">{{ $errors->first('new_password') }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="re_password" class="form-label">Re-enter Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="re_password" name="re_password" autocomplete="off" placeholder="Re-enter Password">
                            <p class="mt-1 tx-13 text-danger">{{ $errors->first('re_password') }}</p>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="reset" class="btn btn-secondary">Clear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection