@extends('admin.layouts.auth-layout', ['title' => env('APP_NAME'), 'page' => 'Forgot Password'])
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
                    <form method="POST" action="{{ route('admin.send-reset-password-link') }}" class="forms-sample">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                            <p class="mt-1 tx-13 text-danger">{{ $errors->first('email') }}</p>
                        </div>
                        <div>
                            <button class="btn btn-primary me-2 mb-2 mb-md-0 text-white">Send Email</button>
                            <a href="{{ route('admin.login') }}" class="btn btn-link mb-2 mb-md-0">
                                Back To Login
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection