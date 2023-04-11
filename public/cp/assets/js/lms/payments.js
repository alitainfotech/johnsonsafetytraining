$(document).ready(function () {
    var csrf_token = $('meta[name="csrf-token"]').attr('content')

    $('#tblpaymentsList').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax":{
                 "url": config.routes.ajaxIndex,
                 "dataType": "json",
                 "type": "POST",
                 "data":{ _token: csrf_token}
               },
        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "full_name" },
            { "data": "user_name" },
            { "data": "email" },
            { "data": "phone" },
            { "data": "address" },
            { "data": "payment_id" },
            { "data": "total" },
            // { "data": "actions" }
        ]

    // $(document).on("click", ".delete", function(event) {
    //     var id = $(this).data("id");
    //     var route = $(this).data("route");
    //     console.log(route);
    //     $.ajax({
    //         url: route,
    //         type: 'DELETE',
    //         dataType: "JSON",
    //         data: {
    //             "id": id,
    //             "_token": csrf_token
    //         },
    //         // "data":{ _token: csrf_token,id:id},
    //         success: function (response) {
    //             if(response.delete) {
    //                 // products.DataTable().ajax().reload();
    //                 window.location.reload();
    //             }
    //         }
    //     });
    //     console.log("It failed");
    });
});
