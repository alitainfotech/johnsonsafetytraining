<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="{{ env('APP_NAME') ?? '' }} - {{ 'Export calendar' ?? '' }}">
    <meta name="author" content="{{ env('APP_NAME') ?? '' }}">
    <meta name="keywords" content="{{ env('APP_NAME') ?? '' }} - {{ 'Export calendar' ?? '' }}">
    <title>{{ env('APP_NAME') ?? '' }} - {{ 'Export calendar' ?? '' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('cp/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('cp/assets/images/favicon.png') }}" />
	<script type="text/javascript"> var base_url = '{{ url('/') }}'; </script>
    <style>
        body {
            font-family: "Roboto", Helvetica, sans-serif
        }
    </style>
</head>
<body>
    <script src="{{ asset('cp/assets/vendors/core/core.js') }}"></script>
    <script src="{{ asset('cp/assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('cp/assets/js/lms/icalendar.js?v='.time()) }}"></script>
    <script src="{{ asset('cp/assets/js/lms/custom.js?v='.time()) }}"></script>
    <script>
        var config = {
            routes: {
                ajaxCalendarExport: '{{ route('admin.calendars.ajaxCalendarExport') }}',
            }
        };
        $.ajax({
            url: config.routes.ajaxCalendarExport + location.search,
            type: "GET",
            success: function (response) {
                if(response.status) {
                    // setup ics
                    var cal = ics();
                    // go through each event from the json and add an event for it to ics
                    var $eventsJSON = response.calendars;
                    $.each($eventsJSON,function(i, $event) {
                        if($event.end_at !== null) {
                            cal.addEvent($event.title, $event.description, $event.location, $event.start_at, $event.end_at);
                        } else {
                            cal.addEvent($event.title, $event.description, $event.location, $event.start_at, '');
                        }
                    });
                    cal.download('ICalendar-' + $.now(),'.ics');
                } else {
                    displayMessage(response.message, 'error');
                }
            },
            error: function (response) {
                displayMessage("Something went wrong", 'error');
            },
        });
    </script>
</body>
</html>