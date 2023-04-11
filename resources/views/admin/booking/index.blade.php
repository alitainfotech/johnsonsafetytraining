@extends('admin.layouts.app-layout', ['title' => env('APP_NAME'), 'page' => 'Booking'])
@push('styles')
    <link rel="stylesheet" href="{{ asset('cp/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('cp/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cp/assets/css/lms/custom.css?v='.time()) }}">
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Booking</li>
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
                            <h6 class="card-title mb-0 mt-2 lh-lg">Booking List</h6>
                        </div>
                        <div class="col-md-3">
                            <select id='select_courses' class="form-control">
                                <option value=''>All Courses</option>
                                @foreach($courses as $course)
                                   <option value='{{ $course->id }}'>{{ $course->name }}</option>
                                @endforeach
                             </select>
                        </div>
                        <div class="col-md-3">
                            <select id='course_select_date' class="form-control">
                                <option value=''>Select Date</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tblbookingList" class="table" width="100%">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>User Name</th>
                                    <th>Course Name</th>
                                    <th>Start Date</th>
                                    <th>Duration</th>
                                    <th>Enrolment</th>
                                    <th>Action</th>
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

    <div id="showRescheduleModal" class="modal fade">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="modalTitle2" class="modal-title">Reschedule</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"><span class="visually-hidden">close</span></button>
                </div>
                <div id="modalBody3" class="modal-body">
                    <div class="d-flex align-items-start">
                        <select id='reschedule_select_date' class="form-control">
                            <option value=''>Select Date</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btnReschedule" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        var config = {
                routes: {
                    ajaxIndex: '{{ route('admin.booking.ajaxIndex') }}',
                    ajaxCourses : '{{ route('admin.booking.ajaxCourses') }}',
                    ajaxReschedule : '{{ route('admin.booking.ajaxReschedule') }}',
                }
            };
    </script>
    <script src="{{ asset('cp/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('cp/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('cp/assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('cp/assets/js/lms/booking.js?v='.time()) }}"></script>
    <script src="{{ asset('cp/assets/js/lms/custom.js?v='.time()) }}"></script>
@endpush
