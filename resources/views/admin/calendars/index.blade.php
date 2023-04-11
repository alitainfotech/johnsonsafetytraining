@extends('admin.layouts.app-layout', ['title' => env('APP_NAME'), 'page' => 'Calendar'])
@push('styles')
    <link rel="stylesheet" href="{{ asset('cp/assets/vendors/fullcalendar/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cp/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cp/assets/vendors/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cp/assets/css/lms/custom.css?v='.time()) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Calendar</li>
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
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <button type="button" class="btn btn-primary" id="iCalDownloadModal">Export</button>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <label for="course_filter" class="col-sm-5 col-form-label">Detailed month view for : </label>
                                <div class="col-sm-7">
                                    <select class="form-select form-control form-control-sm" id="course_filter" name="course_filter">
                                        <option value="0">All courses</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}" id="course">{{ ucwords($course->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div id='fullcalendar'></div>
                </div>
            </div>
        </div>
        <div class="col-4 col-md-4">
            <div class="card">
                <div class="card-header">Event Key</div>
                <div class="card-body">
                    <div class="list-group" id="listGroupType">
                        <label class="list-group-item">
                            <input class="form-check-input me-1" type="checkbox" name="type[]" value="4" />
                            <i class="icon fa fa-globe fa-fw " aria-hidden="true"></i>
                            <label for="myCheckbox">Hide</label> global events
                        </label>
                        <label class="list-group-item">
                            <input class="form-check-input me-1" type="checkbox" name="type[]" value="2" />
                            <i class="icon fa fa-cubes fa-fw " aria-hidden="true"></i>
                            <label for="myCheckbox">Hide</label> category events
                        </label>
                        <label class="list-group-item">
                            <input class="form-check-input me-1" type="checkbox" name="type[]" value="1" />
                            <i class="icon fa fa-university fa-fw  " aria-hidden="true"></i>
                            <label for="myCheckbox">Hide</label> course events
                        </label>
                        <label class="list-group-item">
                            <input class="form-check-input me-1" type="checkbox" name="type[]" value="3" />
                            <i class="icon fa fa-group fa-fw  " aria-hidden="true"></i>
                            <label for="myCheckbox">Hide</label> group events
                        </label>
                        <label class="list-group-item">
                            <input class="form-check-input me-1" type="checkbox" name="type[]" value="0" />
                            <i class="icon fa fa-user fa-fw  " aria-hidden="true"></i>
                            <label for="myCheckbox">Hide</label> user events
                        </label>
                    </div>
                </div>
            </div>
            <div id="previous-month" class="calendar"></div>
            <div id="current-month" class="calendar"></div>
            <div id="next-month" class="calendar"></div>
        </div>
        <div id="createEventModal" class="modal fade">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 id="modalTitle2" class="modal-title">Add</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"><span class="visually-hidden">close</span></button>
                    </div>
                    <div id="modalBody2" class="modal-body">
                        <form id="formEventAdd" method="POST" onsubmit="return false;">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ old('title') }}">
                            </div>
                            <div class="mb-3">
                                <label for="start_at" class="form-label">Start Date</label>
                                <div class="input-group">
                                    <input type="text" class="form-control date-time" id="start_at" name="start_at" placeholder="Start Date" value="{{ old('start_at') }}" readonly="readonly">
                                    {{--  <span class="input-group-text input-group-addon" data-toggle=""><i data-feather="calendar"></i></span>  --}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <select class="form-select" id="type" name="type">
                                    <option value="0" selected="selected">User</option>
                                    <option value="1">Course</option>
                                    <option value="2">Category</option>
                                    <option value="3">Site</option>
                                </select>
                            </div>
                            <div class="mb-3" id="course_wrapper" style="display: none;">
                                <label for="course_id" class="form-label">Course</label>
                                <select class="form-select" id="course_id" name="course_id">
                                    <option value="" selected="selected">Select course</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3" id="category_wrapper" style="display: none;">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-select" id="category_id" name="category_id">
                                    <option value="" selected="selected">Select category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                                <textarea type="text" class="form-control description" id="description" name="description" autocomplete="off" placeholder="Description">{{ old('description') }}</textarea>
                                <p class="mt-1 tx-13 text-danger">{{ $errors->first('description') }}</p>
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control" id="location" name="location" placeholder="Location" value="{{ old('location') }}">
                            </div>
                            <div class="mb-3">
                                <label for="duration_type" class="form-label">Duration</label>
                                <select class="form-select" id="duration_type" name="duration_type">
                                    <option value="0" selected="selected">Without Duration</option>
                                    <option value="1">Until</option>
                                    <option value="2">Duration In Minutes</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="end_at" class="form-label">End Date</label>
                                <div class="input-group">
                                    <input type="text" class="form-control date-time" id="end_at" name="end_at" placeholder="End Date" value="{{ old('end_at') }}" readonly="readonly" disabled="disabled">
                                    {{--  <span class="input-group-text input-group-addon" data-toggle="">
                                        <i data-feather="calendar"></i>
                                    </span>  --}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="duration_in_minute" class="form-label">Duration In Minutes</label>
                                <input type="text" class="form-control numberonly" id="duration_in_minute" name="duration_in_minute" placeholder="Duration In Minute" value="{{ old('duration_in_minute') }}" disabled="disabled">
                            </div>
                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="is_repeat" name="is_repeat" value="1">
                                <label class="form-check-label" for="is_repeat">Repeat This Event</label>
                            </div>
                            <div class="mb-3">
                                <label for="repeat_times" class="form-label">Repeat Weekly, Creating Altogether</label>
                                <input type="text" class="form-control numberonly" id="repeat_times" name="repeat_times" placeholder="Repeat Times" value="{{ old('repeat_times', '1') }}" disabled="disabled">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="btnAddEvent" class="btn btn-primary">Add</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="editEventModal" class="modal fade">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 id="modalTitle2" class="modal-title">Edit</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"><span class="visually-hidden">close</span></button>
                    </div>
                    <div id="modalBody2" class="modal-body">
                        <form id="formEventEdit" method="POST" onsubmit="return false;">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title_edit" name="title" placeholder="Title" value="{{ old('title') }}">
                            </div>
                            <div class="mb-3">
                                <label for="start_at" class="form-label">Start Date</label>
                                <div class="input-group">
                                    <input type="text" class="form-control date-time" id="start_at_edit" name="start_at" placeholder="Start Date" value="{{ old('start_at') }}" readonly="readonly">
                                    <span class="input-group-text input-group-addon" data-toggle=""><i data-feather="calendar"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <select class="form-select" id="type_edit" name="type">
                                    <option value="0" selected="selected">User</option>
                                    <option value="1">Course</option>
                                    <option value="2">Category</option>
                                    <option value="3">Site</option>
                                </select>
                            </div>
                            <div class="mb-3" id="course_wrapper_edit" style="display: none;">
                                <label for="course_id_edit" class="form-label">Course</label>
                                <select class="form-select" id="course_id_edit" name="course_id_edit">
                                    <option value="" selected="selected">Select course</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3" id="category_wrapper_edit" style="display: none;">
                                <label for="category_id_edit" class="form-label">Category</label>
                                <select class="form-select" id="category_id_edit" name="category_id_edit">
                                    <option value="" selected="selected">Select category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="description_edit" class="form-label">Description <span class="text-danger">*</span></label>
                                <textarea type="text" class="form-control description" id="description_edit" name="description" autocomplete="off" placeholder="Description">{{ old('description') }}</textarea>
                                <p class="mt-1 tx-13 text-danger">{{ $errors->first('description') }}</p>
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control" id="location_edit" name="location" placeholder="Location" value="{{ old('location') }}">
                            </div>
                            <div class="mb-3">
                                <label for="duration_type_edit" class="form-label">Duration</label>
                                <select class="form-select" id="duration_type_edit" name="duration_type">
                                    <option value="0" selected="selected">Without Duration</option>
                                    <option value="1">Until</option>
                                    <option value="2">Duration In Minutes</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="end_at_edit" class="form-label">End Date</label>
                                <div class="input-group">
                                    <input type="text" class="form-control date-time" id="end_at_edit" name="end_at" placeholder="End Date" value="{{ old('end_at') }}" readonly="readonly" disabled="disabled">
                                    <span class="input-group-text input-group-addon" data-toggle="">
                                        <i data-feather="calendar"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="duration_in_minute_edit" class="form-label">Duration In Minutes</label>
                                <input type="text" class="form-control numberonly" id="duration_in_minute_edit" name="duration_in_minute" placeholder="Duration In Minute" value="{{ old('duration_in_minute') }}" disabled="disabled">
                            </div>
                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="is_repeat_edit" name="is_repeat" value="1">
                                <label class="form-check-label" for="is_repeat_edit">Repeat This Event</label>
                            </div>
                            <div class="mb-3">
                                <label for="repeat_times_edit" class="form-label">Repeat Weekly, Creating Altogether</label>
                                <input type="text" class="form-control numberonly" id="repeat_times_edit" name="repeat_times" placeholder="Repeat Times" value="{{ old('repeat_times') }}" disabled="disabled">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="btnUpdateEvent" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="showEventModal" class="modal fade">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 id="modalTitle2" class="modal-title">Show</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"><span class="visually-hidden">close</span></button>
                    </div>
                    <div id="modalBody3" class="modal-body">
                        <div class="d-flex align-items-start">
                            <div>
                                <h5 class="mb-3" id="titles"></h5>
                                <p class="mb-3 d-inline-block w-100"><i data-feather="clock"></i> <span id="durations"></span></p>
                                <p class="mb-3 d-inline-block w-100"><i data-feather="calendar"></i> <span id="types"></span></p>
                                <p class="mb-3 d-inline-block w-100"><i data-feather="bookmark"></i> <span id="type_names"></span></p>
                                <p class="mb-3 d-inline-block w-100"><i data-feather="align-left"></i> <span id="descriptions"></span></p>
                                <p class="mb-3 d-inline-block w-100"><i data-feather="map-pin"></i> <span id="locations"></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btnEditEvent" class="btn btn-warning">Edit</button>
                        <button id="btnDeleteEvent" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="exportEventModal" class="modal fade">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <form id="formEventExport" method="POST" onsubmit="return false;">
                        @csrf
                        <div class="modal-header">
                            <h4 id="modalTitle2" class="modal-title">Export</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"><span class="visually-hidden">close</span></button>
                        </div>
                        <div id="modalBody4" class="modal-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <a target="_blank" href="https://docs.moodle.org/37/en/calendar/export">
                                        <i data-feather="info"></i> How do I subscribe to this calendar from a calendar application (Google/Outlook/Other)?
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-check-label mb-2">Events to export :</label>
                                    <div class="form-check mb-2">
                                        <input type="radio" class="form-check-input" name="events_to_export" id="all_events" value="all_events" checked="checked">
                                        <label class="form-check-label" for="all_events">All events</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input type="radio" class="form-check-input" name="events_to_export" id="events_related_to_categories" value="events_related_to_categories">
                                        <label class="form-check-label" for="events_related_to_categories">Events related to categories</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input type="radio" class="form-check-input" name="events_to_export" id="events_related_to_courses" value="events_related_to_courses">
                                        <label class="form-check-label" for="events_related_to_courses">Events related to courses</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input type="radio" class="form-check-input" name="events_to_export" id="events_related_to_groups" value="events_related_to_groups">
                                        <label class="form-check-label" for="events_related_to_groups">Events related to groups</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="events_to_export" id="my_personal_events" value="my_personal_events">
                                        <label class="form-check-label" for="my_personal_events">My personal events</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-check-label mb-2">Time period :</label>
                                    <div class="form-check mb-2">
                                        <input type="radio" class="form-check-input" name="time_period" id="this_week" value="this_week">
                                        <label class="form-check-label" for="this_week">This week</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input type="radio" class="form-check-input" name="time_period" id="this_month" value="this_month" checked="checked">
                                        <label class="form-check-label" for="this_month">This month</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input type="radio" class="form-check-input" name="time_period" id="next_month" value="next_month">
                                        <label class="form-check-label" for="next_month">Next month</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input type="radio" class="form-check-input" name="time_period" id="recent_and_next_60_days" value="recent_and_next_60_days">
                                        <label class="form-check-label" for="recent_and_next_60_days">Recent and next 60 days</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input type="radio" class="form-check-input" name="time_period" id="custom_range" value="custom_range">
                                        <label class="form-check-label" for="custom_range">Custom range</label>
                                    </div>
                                    <span class="input-group" id="custom_range_date_wrapper" style="display: none;">
                                        <input type="text" class="form-control flatpickr" id="custom_range_date" name="custom_range_date" autocomplete="off" placeholder="Select date" readonly="readonly">
                                        <span class="input-group-text input-group-addon"><i data-feather="calendar"></i></span>
                                    </span>
                                </div>
                            </div>
                            <div class="mt-3" id="calendarExportUrl"></div>
                        </div>
                        <div class="modal-footer">
                            <button id="iCalDownloadExport" class="btn btn-primary">Export Calendar</button>
                            <button id="iCalGenerateUrl" class="btn btn-info">Get Calendar URL</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        var config = {
                routes: {
                    ajaxIndex: '{{ route('admin.calendars.ajaxIndex') }}',
                    ajaxPrevious: '{{ route('admin.calendars.ajaxPrevious') }}',
                    ajaxNext: '{{ route('admin.calendars.ajaxNext') }}',
                    filterCourse: '{{ route('admin.calendars.filterCourse') }}',
                    ajaxCheckbox: '{{ route('admin.calendars.ajaxCheckbox') }}',
                    ajaxCalendar: '{{ route('admin.calendars.ajaxCalendar') }}',
                    ajaxCalendarExport: '{{ route('admin.calendars.ajaxCalendarExport') }}',
                    ajaxCalendarLinkGenerate: '{{ route('admin.calendars.ajaxCalendarLinkGenerate') }}',
                }
            };
    </script>
    <script src="{{ asset('cp/assets/vendors/tinymce/tinymce.min.js?v='.time()) }}"></script>
    <script src="{{ asset('cp/assets/vendors/moment/moment.min.js') }}"></script>
    <script src="{{ asset('cp/assets/vendors/fullcalendar/main.min.js') }}"></script>
    <script src="{{ asset('cp/assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('cp/assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('cp/assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('cp/assets/js/lms/icalendar.js?v='.time()) }}"></script>
    <script src="{{ asset('cp/assets/js/lms/calendars.js?v='.time()) }}"></script>
    <script src="{{ asset('cp/assets/js/lms/custom.js?v='.time()) }}"></script>
@endpush
