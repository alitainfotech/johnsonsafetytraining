@extends('admin.layouts.app-layout', ['title' => env('APP_NAME'), 'page' => 'Date Create'])
@push('styles')
    <link rel="stylesheet" href="{{ asset('cp/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cp/assets/css/lms/custom.css?v='.time()) }}">
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            {{--  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Courses</a></li>  --}}
            <li class="breadcrumb-item active" aria-current="page">Purchased Courses</li>
        </ol>
    </nav>
            <div class="row">
                @foreach ($studentcourse as $key=>$course)
                    {{--  {{ $course }}  --}}
                    {{-- <a href="{{ route('user.products.studentmaterial',$key) }}">
                        {{ $course }}
                    </a> --}}
                    <div class="col-lg-4 col-md-6">
                        <a href="{{ route('user.products.studentmaterial',$course[0]->product->id) }}">
                            <div class="card">
                                <div class="single-course-inner">
                                    <div class="thumb">
                                        <img src="{{ $course[0]->product->images()->type('1')->path}}" alt="img" width="100%" height="300px" class="rounded">
                                    </div>
                                    <div class="details p-2 text-center">
                                        <div class="details-inner">
                                            <div class="emt-user">
                                                <h4 class="align-self-center title">{{ $course[0]->product->name }}</h4>
                                            </div>
                                            <h6>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            <div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="{{ asset('cp/assets/vendors/tinymce/tinymce.min.js?v='.time()) }}"></script>
<script src="{{ asset('cp/assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('cp/assets/js/lms/custom.js?v='.time()) }}"></script>
@endpush
