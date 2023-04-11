@extends('admin.layouts.auth-layout', ['title' => env('APP_NAME'), 'page' => 'Page Not Found'])
@section('content')
    <div class="col-md-8 col-xl-6 mx-auto d-flex flex-column align-items-center">
        <img src="{{ asset('cp/assets/images/others/404.svg') }}" class="img-fluid mb-2" alt="404">
        <h1 class="fw-bolder mb-22 mt-2 tx-80 text-muted">500</h1>
        <h4 class="mb-2">Internal server error</h4>
        <h6 class="text-muted mb-3 text-center">Oopps!! There wan an error. Please try agin later.</h6>
        <a href="{{ route('admin.dashboard') }}">Back To Dashboard</a>
    </div>
@endsection