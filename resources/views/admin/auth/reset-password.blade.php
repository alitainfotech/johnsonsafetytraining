@extends('admin.layouts.auth-layout', ['title' => env('APP_NAME'), 'page' => 'Reset Password'])
@section('content')
<div class="col-md-8 col-xl-6 mx-auto">
    <div class="card">
        <div class="row">
            <div class="col-md-4 pe-md-0">
                <div class="auth-side-wrapper"></div>
            </div>
            <div class="col-md-8 ps-md-0">
                <div class="auth-form-wrapper px-4 py-5">
                    <a href="javascript:void(0);" class="noble-ui-logo d-block mb-3">LM<span>S</span></a>
                    @if (session()->has('message'))
                        <div class="alert alert-{{ session()->get('type') }} alert-dismissible fade show" role="alert">
                            {{ session()->get('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('admin.reset-new-password') }}" class="forms-sample">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" autocomplete="off" placeholder="Password">
                            <p class="mt-1 tx-13 text-danger">{{ $errors->first('new_password') }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" autocomplete="off" placeholder="Password">
                            <p class="mt-1 tx-13 text-danger">{{ $errors->first('confirm_password') }}</p>
                        </div>
                        <div>
                            <button class="btn btn-primary me-2 mb-2 mb-md-0 text-white">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection