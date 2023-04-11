@extends('admin.layouts.auth-layout', ['title' => env('APP_NAME'), 'page' => 'Login'])
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
                    <form action="{{ route('admin.verify-login') }}" method="POST" class="forms-sample">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                            <p class="mt-1 tx-13 text-danger">{{ $errors->first('email') }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" autocomplete="off" placeholder="Password">
                            <p class="mt-1 tx-13 text-danger">{{ $errors->first('password') }}</p>
                        </div>
                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="remember_me" name="remember_me">
                            <label class="form-check-label" for="remember_me"> Remember me</label>
                        </div>
                        <div>
                            <button class="btn btn-primary me-2 mb-2 mb-md-0 text-white">Login</button>
                            <a href="{{ route('admin.forgot-password') }}" class="btn btn-link mb-2 mb-md-0">
                                Forgot Password
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection