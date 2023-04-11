if($("#fullcalendar").length) {
    document.addEventListener('DOMContentLoaded', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var calendarEl = document.getElementById('fullcalendar');
        // initialize the calendar
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: "prev,today,next",
                center: 'title',
                right: ''
            },
            editable: true,
            displayEventTime: false,
            eventRender: function (event, element, view,info) {
                event.title = (event.allDay === 'true') ? true : false;
            },
            eventDidMount: function (event) {
                $(event.el).attr('data-bs-toggle', 'popover')
                        .attr('data-bs-placement', 'top')
                        .attr('title', event.el.text)
                        .attr('data-bs-title', event.el.text)
                        .attr('data-bs-trigger', 'hover')
                        // .attr('data-bs-content', event.el.text);
                $('[data-bs-toggle="popover"]').popover();
            },
            allDay: true,
            selectable: false,
            selectHelper: false,
            eventDisplay: 'block',
            eventSources: [{
                url: config.routes.ajaxIndex
            }],
            eventDrop: function (event, delta) {
                var start = moment(event.event.start).format('YYYY-MM-DD hh:mm');
                var end = moment(event.event.end).format('YYYY-MM-DD hh:mm');
                $.ajax({
                    url: config.routes.ajaxCalendar,
                    type: "POST",
                    data: {
                        'start_at': start,
                        'end_at': end,
                        'id': event.event.id,
                        'methodType': 'update'
                    },
                    success: function (response) {
                        displayMessage("Event Updated Successfully", 'success');
                    }
                });
            },
            eventClick: function(info) {
                $.ajax({
                    type: "POST",
                    url: config.routes.ajaxCalendar,
                    data: {
                        'id': info.event.id,
                        'methodType': 'show'
                    },
                    success: function (response) {
                        $("#showEventModal").modal("show");
                        $("#titles").html(response.title);
                        if(response.end_at !== null) {
                            $("#durations").html(response.start_at + ' - ' + response.end_at);
                        } else {
                            $("#durations").html(response.start_at);
                        }
                        $("#types").html(response.type_text + ' ' + 'event');
                        $("#type_names").html(response.type_name_text);
                        $("#descriptions").html(response.description);
                        $("#locations").html(response.location);
                        $('#btnEditEvent').attr('data-id', info.event.id);
                        $('#btnDeleteEvent').attr('data-id', info.event.id);
                    },
                    error: function(response, status, err) {
                    }
                });
            },
            dateClick: function(info) {
                $('#formEventAdd')[0].reset();
                $("#createEventModal").modal("show");
                start = moment(info.dateStr).format('YYYY-MM-DD hh:mm')
                $('#start_at').val(start + ' 00:00');
                $("#btnAddEvent").on('click', function() {
                    // var start = moment($('#start_at').val()).format('YYYY-MM-DD hh:mm');
                    if($('#duration_type').val() == '1') {
                        var end = moment($('#end_at').val()).format('YYYY-MM-DD hh:mm');
                    } else if ($('#duration_type').val() == '2') {
                        var end = moment(start).add($('#duration_in_minute').val(), 'minutes').format('YYYY-MM-DD hh:mm');
                    }

                    var CurrentDate = moment(new Date()).format('YYYY-MM-DD');
                    var GivenDate = moment(start).format('YYYY-MM-DD');
                    if(CurrentDate > GivenDate) {
                        displayMessage("Cannot set event before course start date", 'error');
                        return false;
                    }

                    var title = $("#title").val();
                    if(title.trim() == '') {
                        displayMessage("You can not enter empty title", 'error');
                        return false;
                    }

                    var form = $("#formEventAdd")[0];
                    var formData = new FormData(form);
                    formData.append('title', title);
                    formData.append('start_at', start);
                    formData.append('type', $('#type').val());
                    formData.append('description', tinymce.get("description").getContent());
                    formData.append('location', $('#location').val());
                    formData.append('duration_type', $('#duration_type').val());
                    if(typeof end !== "undefined") {
                        formData.append('end_at', end);
                    }
                    if(typeof $('#duration_in_minute').val() !== "undefined") {
                        formData.append('duration_in_minute', $('#duration_in_minute').val());
                    }
                    formData.append('is_repeat', $('#is_repeat').val());
                    if(typeof $('#repeat_times').val() !== "undefined") {
                        formData.append('repeat_times', $('#repeat_times').val());
                    }
                    formData.append('methodType', 'add');
                    $.ajax({
                        url: config.routes.ajaxCalendar,
                        data: formData,
                        processData: false,
                        contentType: false,
                        type: "POST",
                        success: function (data) {
                            $("#createEventModal").modal("hide");
                            calendar.refetchEvents();
                            displayMessage("Event Created Successfully", 'success');
                        }
                    });
                });
            },
        });
        calendar.render();

        var calendar1 = new FullCalendar.Calendar(document.getElementById('previous-month'), {
            headerToolbar: {
                left: '',
                center: 'title',
                right: ''
            },
            eventDidMount: function (event) {
                $(event.el).attr('data-bs-toggle', 'popover')
                        .attr('data-bs-placement', 'top')
                        .attr('title', event.el.text)
                        .attr('data-bs-title', event.el.text)
                        .attr('data-bs-trigger', 'hover')
                        // .attr('data-bs-content', event.el.text);
                $('[data-bs-toggle="popover"]').popover();
            },
            eventSources: [{
                url: config.routes.ajaxPrevious
            }],
        });

        var calendar2 = new FullCalendar.Calendar(document.getElementById('current-month'), {
            headerToolbar: {
                left: '',
                center: 'title',
                right: ''
            },
            // defaultDate: moment().calendar()
            displayEventTime: false,
            eventDisplay: 'block',
            eventDidMount: function (event) {
                $(event.el).attr('data-bs-toggle', 'popover')
                        .attr('data-bs-placement', 'top')
                        .attr('title', event.el.text)
                        .attr('data-bs-title', event.el.text)
                        .attr('data-bs-trigger', 'hover')
                        // .attr('data-bs-content', event.el.text);
                $('[data-bs-toggle="popover"]').popover();
            },
            eventSources: [{
                url: config.routes.ajaxIndex
            }],
        });

        var calendar3 = new FullCalendar.Calendar(document.getElementById('next-month'), {
            headerToolbar: {
                left: '',
                center: 'title',
                right: ''
            },
            displayEventTime: false,
            eventDisplay: 'block',
            eventDidMount: function (event) {
                $(event.el).attr('data-bs-toggle', 'popover')
                        .attr('data-bs-placement', 'top')
                        .attr('title', event.el.text)
                        .attr('data-bs-title', event.el.text)
                        .attr('data-bs-trigger', 'hover')
                        // .attr('data-bs-content', event.el.text);
                $('[data-bs-toggle="popover"]').popover();
            },
            eventSources: [{
                url: config.routes.ajaxNext
            }],
        });

        calendar1.render();
        calendar1.prev();
        calendar2.render();
        calendar3.render();
        calendar3.next();

        $('#course_filter').change(function() {
            $.ajax({
                url: config.routes.filterCourse,
                type: "POST",
                data: {
                    'course_id': $(this).val(),
                },
                success: function (response) {
                    // Main calendar
                    var eventSources = calendar.getEventSources();
                    eventSources[0].remove();
                    calendar.addEventSource(response.eventsCurrent);
                    calendar.refetchEvents();

                    // Prev calendar
                    var eventSources1 = calendar1.getEventSources();
                    eventSources1[0].remove();
                    calendar1.addEventSource(response.eventsPrev);
                    calendar1.refetchEvents();

                    // Current calendar
                    var eventSources2 = calendar2.getEventSources();
                    eventSources2[0].remove();
                    calendar2.addEventSource(response.eventsCurrent);
                    calendar2.refetchEvents();

                    // Next calendar
                    var eventSources3 = calendar3.getEventSources();
                    eventSources3[0].remove();
                    calendar3.addEventSource(response.eventsNext);
                    calendar3.refetchEvents();
                },
            });
        });

        $('#listGroupType .form-check-input').change(function() {
            var data = [];
            $(':checkbox:checked').each(function(i){
              data[i] = $(this).val();
              document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
                    checkbox.addEventListener('change', function (event) {
                        let checkboxLabel = document.querySelector('label[for="myCheckbox"]');
                        if (checkboxLabel) checkboxLabel.textContent = checkbox.checked?"Show":"Hide";
                    });
                });
            });
            $.ajax({
                url: config.routes.ajaxCheckbox,
                type: "POST",
                data: {
                    'type': data,
                },
                success: function (response) {

                    //main calender
                    var eventSources = calendar.getEventSources();
                    eventSources[0].remove();
                    calendar.addEventSource(response.eventsCurrent);
                    calendar.refetchEvents();

                    // Prev calendar
                    var eventSources1 = calendar1.getEventSources();
                    eventSources1[0].remove();
                    calendar1.addEventSource(response.eventsPrev);
                    calendar1.refetchEvents();

                    // Current calendar
                    var eventSources2 = calendar2.getEventSources();
                    eventSources2[0].remove();
                    calendar2.addEventSource(response.eventsCurrent);
                    calendar2.refetchEvents();

                    // Next calendar
                    var eventSources3 = calendar3.getEventSources();
                    eventSources3[0].remove();
                    calendar3.addEventSource(response.eventsNext);
                    calendar3.refetchEvents();
                },
            });

        });



        $('#type').on('change', function() {
            if($(this).val() == '1') {
                $('#category_id').val(null);
                $('#course_wrapper').show();
                $('#category_wrapper').hide();
            } else if ($(this).val() == '2') {
                $('#course_id').val(null);
                $('#category_wrapper').show();
                $('#course_wrapper').hide();
            } else {
                $('#course_id').val(null);
                $('#category_id').val(null);
                $('#course_wrapper').hide();
                $('#category_wrapper').hide();
            }
        });

        $('#type_edit').on('change', function() {
            if($(this).val() == '1') {
                $('#course_wrapper_edit').show();
                $('#category_id').val(null);
                $('#category_id_edit').val(null);
                $('#category_wrapper_edit').hide();
            } else if ($(this).val() == '2') {
                $('#category_wrapper_edit').show();
                $('#course_id').val(null);
                $('#course_id_edit').val(null);
                $('#course_wrapper_edit').hide();
            } else {
                $('#course_id').val(null);
                $('#course_id_edit').val(null);
                $('#category_id').val(null);
                $('#category_id_edit').val(null);
                $('#course_wrapper_edit').hide();
                $('#category_wrapper_edit').hide();
            }
        });

        $(document).on('hidden.bs.modal', '#showEventModal', function () {
            $('#btnEditEvent').unbind('click');
            $('#btnDeleteEvent').unbind('click');
            $('#btnEditEvent').removeAttr('data-id');
            $('#btnDeleteEvent').removeAttr('data-id');
        });

        $(document).on('hidden.bs.modal', '#editEventModal', function () {
            $('#btnUpdateEvent').unbind('click');
            $('#btnUpdateEvent').removeAttr('data-id');
        });

        $(document).on('click', '#btnEditEvent', function () {
            $('#formEventEdit')[0].reset();
            $("#showEventModal").modal("hide");
            $("#editEventModal").modal("show");
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: config.routes.ajaxCalendar,
                data: {
                    'id': id,
                    'methodType': 'showEdit'
                },
                success: function (response) {
                    $("#title_edit").val(response.title);
                    $("#start_at_edit").val(moment(response.start_at).format('YYYY-MM-DD hh:mm'));
                    $('#type_edit option[value="'+ response.type + '"]').attr("selected", "selected");
                    if(response.type == '1') {
                        $('#course_wrapper_edit').show();
                        $('#category_id_edit').val(null);
                        $('#category_wrapper_edit').hide();
                        if($('#course_id_edit').length) {
                            $('#course_id_edit option[value="'+ response.type_id + '"]').attr("selected", "selected");
                        }
                    } else if (response.type == '2') {
                        $('#category_wrapper_edit').show();
                        $('#course_id_edit').val(null);
                        $('#course_wrapper_edit').hide();
                        if($('#category_id_edit').length) {
                            $('#category_id_edit option[value="'+ response.type_id + '"]').attr("selected", "selected");
                        }
                    } else {
                        $('#course_wrapper_edit').hide();
                        $('#category_wrapper_edit').hide();
                        $('#course_id_edit').val(null);
                        $('#category_id_edit').val(null);
                    }
                    if(response.description !== null) {
                        tinymce.get('description_edit').setContent(response.description);
                    }
                    $("#location_edit").val(response.location);
                    $('#duration_type_edit option[value="'+ response.duration_type + '"]').attr("selected", "selected");
                    $("#end_at_edit").val(moment(response.end_at).format('YYYY-MM-DD hh:mm'));
                    $("#duration_in_minute_edit").val(response.duration_in_minute);
                    $('#is_repeat_edit[type=checkbox][value=' + response.is_repeat + ']').attr('checked', 'checked');
                    $("#repeat_times_edit").val(response.repeat_times);
                    $("#btnUpdateEvent").attr('data-id', response.id);
                    if(response.duration_type == '0') {
                        $("#end_at_edit").prop('disabled', true);
                        $("#end_at_edit").val('');
                        $("#duration_in_minute_edit").prop('disabled', true);
                        $("#duration_in_minute_edit").val('');
                    } else if (response.duration_type == '1') {
                        $("#end_at_edit").prop('disabled', false);
                        $("#duration_in_minute_edit").prop('disabled', true);
                        $("#duration_in_minute_edit").val('');
                    } else if (response.duration_type == '2') {
                        $("#end_at_edit").prop('disabled', true);
                        $("#end_at_edit").val('');
                        $("#duration_in_minute_edit").prop('disabled', false);
                    }
                    if(response.is_repeat == '1') {
                        $("#repeat_times_edit").prop('disabled', false);
                    } else {
                        $("#repeat_times_edit").val('');
                        $("#repeat_times_edit").prop('disabled', true);
                    }
                },
                error: function(response, status, err) {
                    displayMessage('Something went wrong', 'error');
                }
            });
        });

        $(document).on('click', '#btnDeleteEvent', function () {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger me-2'
                },
                buttonsStyling: false,
            });
            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You want to delete!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'me-2',
                confirmButtonText: 'Yes, Delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true,
                closeOnConfirm: true
            }).then((result) => {
                if (result.value) {
                    var id = $(this).attr('data-id');
                    $.ajax({
                        type: "POST",
                        url: config.routes.ajaxCalendar,
                        data: {
                            'id': id,
                            'methodType': 'delete'
                        },
                        success: function (response) {
                            if(response.status) {
                                $("#showEventModal").modal("hide");
                                calendar.refetchEvents();
                                displayMessage(response.message, 'success');
                            } else {
                                $("#showEventModal").modal("hide");
                                displayMessage('Something went wrong', 'error');
                            }
                        },
                        error: function(response, status, err) {
                            displayMessage('Something went wrong', 'error');
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire('Cancelled', 'Delete is cancelled.', 'error');
                }
            });
        });

        $(document).on('click', '#btnUpdateEvent', function () {
            var start = moment($('#start_at_edit').val()).format('YYYY-MM-DD hh:mm');
            if($('#duration_type_edit').val() == '1') {
                var end = moment($('#end_at_edit').val()).format('YYYY-MM-DD hh:mm');
            } else if ($('#duration_type_edit').val() == '2') {
                var end = moment(start).add($('#duration_in_minute_edit').val(), 'minutes').format('YYYY-MM-DD hh:mm');
            }
            var title = $("#title_edit").val();
            if(title.trim() == '') {
                displayMessage("You can not enter empty title", 'error');
                return false;
            }
            var id = $(this).attr('data-id');
            var form = $("#formEventEdit")[0];
            var formData = new FormData(form);
            formData.append('id', id);
            formData.append('title', title);
            formData.append('start_at', start);
            formData.append('type', $('#type_edit').val());
            formData.append('course_id', $('#course_id_edit').val());
            formData.append('category_id', $('#category_id_edit').val());
            formData.append('description', tinymce.get("description_edit").getContent());
            formData.append('location', $('#location_edit').val());
            formData.append('duration_type', $('#duration_type_edit').val());
            if(typeof end !== 'undefined') {
                formData.append('end_at', end);
            }
            formData.append('duration_in_minute', $('#duration_in_minute_edit').val());
            formData.append('is_repeat', $('#is_repeat_edit').val());
            formData.append('repeat_times', $('#repeat_times_edit').val());
            formData.append('methodType', 'update');
            $.ajax({
                url: config.routes.ajaxCalendar,
                data: formData,
                processData: false,
                contentType: false,
                type: "POST",
                success: function (response) {
                    if(response.status) {
                        $("#editEventModal").modal("hide");
                        calendar.refetchEvents();
                        displayMessage(response.message, 'success');
                    } else {
                        displayMessage(response.message, 'error');
                    }
                },
                error: function(response, status, err) {
                    displayMessage('Something went wrong', 'error');
                }
            });
        });

        if($('.date').length) {
            flatpickr(".date-time", {
                defaultDate: "today",
                enableTime: false,
            });
        }

        if($('.date-time').length) {
            flatpickr(".date-time", {
                defaultDate: "today",
                enableTime: true,
            });
        }

        if($('#duration_type').length) {
            $('#duration_type').on('change', function() {
                if($(this).val() == '0') {
                    $("#end_at").prop('disabled', true);
                    $("#duration_in_minute").prop('disabled', true);
                    $("#end_at").val('');
                    $("#duration_in_minute").val('');
                } else if ($(this).val() == '1') {
                    $("#end_at").prop('disabled', false);
                    $("#duration_in_minute").prop('disabled', true);
                    $("#duration_in_minute").val('');
                } else if ($(this).val() == '2') {
                    $("#end_at").prop('disabled', true);
                    $("#end_at").val('');
                    $("#duration_in_minute").prop('disabled', false);
                }
            });
        }

        if($('#is_repeat').length) {
            $('#is_repeat').on('change', function() {
                if(this.checked) {
                    $("#repeat_times").prop('disabled', false);
                } else {
                    $("#repeat_times").val('');
                    $("#repeat_times").prop('disabled', true);
                }
            });
        }

        if($('#duration_type_edit').length) {
            $('#duration_type_edit').on('change', function() {
                if($(this).val() == '0') {
                    $("#end_at_edit").prop('disabled', true);
                    $("#duration_in_minute_edit").prop('disabled', true);
                    $("#end_at_edit").val('');
                    $("#duration_in_minute_edit").val('');
                } else if ($(this).val() == '1') {
                    $("#end_at_edit").prop('disabled', false);
                    $("#duration_in_minute_edit").prop('disabled', true);
                    $("#duration_in_minute_edit").val('');
                } else if ($(this).val() == '2') {
                    $("#end_at_edit").prop('disabled', true);
                    $("#end_at_edit").val('');
                    $("#duration_in_minute_edit").prop('disabled', false);
                }
            });
        }

        if($('#is_repeat_edit').length) {
            $('#is_repeat_edit').on('change', function() {
                if(this.checked) {
                    $("#repeat_times_edit").prop('disabled', false);
                } else {
                    $("#repeat_times_edit").val('');
                    $("#repeat_times_edit").prop('disabled', true);
                }
            });
        }
    });
}

// Download iCal button onclick listener
$("#iCalDownloadExport").on('click',function() {
    var form = $("#formEventExport")[0];
    var formData = new FormData(form);
    $.ajax({
        url: config.routes.ajaxCalendarExport,
        data: formData,
        processData: false,
        contentType: false,
        type: "POST",
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
        error: function(response, status, err) {
            displayMessage("Something went wrong", 'error');
        }
    });
});

$('#createEventModal').on('hidden.bs.modal', function () {
    $('#btnAddEvent').unbind('click');
});

$('#exportEventModal').on('hidden.bs.modal', function () {
    $('#iCalDownloadExport').unbind('click');
});

// Download iCal button onclick listener
$("#iCalDownloadModal").on('click',function() {
    $("#formEventExport")[0].reset();
    $('#custom_range_date')[0]._flatpickr.clear();
    $('#custom_range_date_wrapper').hide();
    $('#calendarExportUrl').html('');
    $("#exportEventModal").modal("show");
});

$('input[type=radio][name=time_period]').on('change', function() {
    if(this.value == 'custom_range') {
        $('#custom_range_date_wrapper').show();
    } else {
        $('#custom_range_date_wrapper').hide();
    }
    $('#custom_range_date')[0]._flatpickr.clear();
});

if($('#custom_range_date').length > 0) {
    flatpickr("#custom_range_date", {
        mode: "range",
        allowInput: true,
        onChange: ([start, end]) => {
            if (start && end) {
                $('#iCalGenerateUrl').trigger('click');
            }
        }
    });
}

$('input[type=radio][name=time_period], input[type=radio][name=events_to_export]').on('change', function() {
    if($(this).val() != 'custom_range') {
        $('#iCalGenerateUrl').trigger('click');
    } else {
        $('#calendarExportUrl').html('');
    }
});

$('#iCalGenerateUrl').on('click', function () {
    var form = $("#formEventExport")[0];
    var formData = new FormData(form);
    let data = Array.from(formData).filter(function([k, v]) {
        if(k != '_token') {
            return v;
        }
    });
    var query_string = new URLSearchParams(data).toString();
    var url = config.routes.ajaxCalendarLinkGenerate + '?' + query_string;

    var calendarLink = $("<a>");
        calendarLink.attr("href", url);
        calendarLink.attr("title", "Calendar URL");
        calendarLink.attr("target", "_blank");
        calendarLink.text(url);

    $("#calendarExportUrl").html(calendarLink);
});


