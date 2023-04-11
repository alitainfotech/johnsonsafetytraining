@extends('admin.layouts.app-layout', ['title' => env('APP_NAME'), 'page' => 'payments'])
@push('styles')
    <link rel="stylesheet" href="{{ asset('cp/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('cp/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cp/assets/css/lms/custom.css?v='.time()) }}">
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Payments</li>
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
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="card-title mb-0 mt-2 lh-lg">Payment List</h6>
                        </div>
                        {{--  <div class="col-md-6 text-end">
                            <a href="{{ route('admin.products.create') }}" type="button" class="btn btn-primary">
                                Add Course
                            </a>
                        </div>  --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tblpaymentsList" class="table" width="100%">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Name</th>
                                    <th>Full Name</th>
                                    <th>User Name</th>
                                    <th>email</th>
                                    <th>phone</th>
                                    <th>address</th>
                                    <th>payment id</th>
                                    <th>total</th>
                                    {{--  <th class="text-center" width="80px;">Action</th>  --}}
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        var config = {
                routes: {
                    ajaxIndex: '{{ route('admin.payments.ajaxIndex') }}'
                }
            };
    </script>
    <script src="{{ asset('cp/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('cp/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('cp/assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('cp/assets/js/lms/payments.js?v='.time()) }}"></script>
    <script src="{{ asset('cp/assets/js/lms/custom.js?v='.time()) }}"></script>
@endpush
