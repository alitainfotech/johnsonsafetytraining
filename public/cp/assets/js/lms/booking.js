$(document).ready(function () {
    var csrf_token = $('meta[name="csrf-token"]').attr('content')

    var empTable = $('#tblbookingList').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax":{
                 "url": config.routes.ajaxIndex,
                 "dataType": "json",
                 "type": "POST",
                //  "data":{ _token: csrf_token}
                "data": function (d) {
                    _token = csrf_token;
                    d.select_courses = $('#select_courses').val();
                    d.select_date = $('#course_select_date').val();
                },
               },
      
        "columns": [
            { "data": "id" },
            { "data": "full_name" },
            { "data": "name" },
            { "data": "start_at" },
            { "data": "duration" },
            { "data": "enrolment" },
            { "data": "actions" }
        ],
    });
    var rescheduleDate = '';
    var type = 'reschedule_date';
    var orderId = '';
    $(document).on('click','#reschedule',function(){
        $("#showRescheduleModal").modal("show");
        rescheduleDate = 'reschedule_';
        var courseId = $(this).data('product');
        orderId = $(this).data('order');
        getAvailableDate(courseId,rescheduleDate,type);
    });

    $('#select_courses,#course_select_date').change(function(){
        // empTable.search($(this).find('option:selected').text()).draw();
        empTable.draw();
    });

    // $(document).on('click','#btnReschedule',function(){
    //     $("#showRescheduleModal").modal("show");
    // });

    var dateType = '';
    $('#select_courses').on('change', function () {
        var courseId = $(this).val();
        dateType = 'course_'
        getAvailableDate(courseId,dateType,'')
    });

    function getAvailableDate(courseId,dateType,type){
        $.ajax({
            url: config.routes.ajaxCourses,
            type: "POST",
            data:{ _token: csrf_token,courseId:courseId,type:type},
            dataType: "json",
            success: function (data) {
                $('#'+dateType+'select_date').empty();
                $('#'+dateType+'select_date').append('<option value="">Select Date</option>');
                $.each(data.avilabledate, function (key, value) {
                    $('#'+dateType+'select_date').append('<option value=" ' + value.id + '">' + value.start_at + '</option>');
                })
            }
        })
    }

    $(document).on('click','#btnReschedule',function(){
        var date = $('#reschedule_select_date').val();
        if(date != ''){
            $.ajax({
                url: config.routes.ajaxReschedule,
                type: "POST",
                data:{ _token: csrf_token,orderId:orderId,date:date},
                dataType: "json",
                success: function (data) {
                    if(data.status == 1){
                        $('#reschedule_select_date').val('');
                        $("#showRescheduleModal").modal("hide");
                        displayMessage(data.message,'success');
                        $('#tblbookingList').DataTable().ajax.reload();
                    }else{
                        displayMessage(data.message,'error');
                    }
                }
            })
        }else{
            displayMessage('Please select date','error');
        }
    });

    // displayMessage
});
