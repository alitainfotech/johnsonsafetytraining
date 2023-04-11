@extends('admin.layouts.auth-layout', ['title' => env('APP_NAME'), 'page' => 'Page Not Found'])
@section('content')
    <div class="col-md-8 col-xl-6 mx-auto d-flex flex-column align-items-center">
        <img src="{{ asset('cp/assets/images/others/404.svg') }}" class="img-fluid mb-2" alt="404">
        <h1 class="fw-bolder mb-22 mt-2 tx-80 text-muted">404</h1>
        <h4 class="mb-2">Page Not Found</h4>
        <h6 class="text-muted mb-3 text-center">Oopps!! The page you were looking for doesn't exist.</h6>
        <a href="{{ route('home') }}">Back To Home</a>
    </div>
@endsection