// const { extendWith } = require("lodash");

$(document).ready(function () {
    if($('#tblProductsList').length > 0) {
        let tblProductsList = $('#tblProductsList');
        let route = config.routes.ajaxIndex;
        let columns = [{ data: 'id' }, { data: 'name' }, { data: 'price' }, { data: 'status' }, { data: 'actions', className: "text-center" }];
        let targets = [0, 4];
        let order = [0, 'DESC'];
        customDataTable(tblProductsList, route, columns, targets, order);
    }

    $(document).on('click', '.deleteRecord', function() {
        let id = $(this).data('id');
        let route = $(this).data('route');
        let tblProductsList = $('#tblProductsList');
        customSweetAlertDataTable(id, route, tblProductsList);
    });

    $('.product-image-button').on('click', function() {
        let id = $(this).data('id');
        let route = $(this).data('route');
        let wrapper = $(this).closest('.product-wrapper');
        customSweetAlert(id, route, wrapper);
    })

    if($('.date-time').length) {
        flatpickr(".date-time", {
            defaultDate: "today",
            enableTime: true,
        });
    }

    $("#date_valid").click(function(){
        if($('[type="checkbox"]').is(":checked")){
            $("#end_at").prop('disabled', false);
        }
        else{
            $("#end_at").prop('disabled', true);
        }
   })

   $("#rowAdder").click(function () {

        newRowAdd = '<div class="mb-3" id="input-group-wrapper">' + '<div class="input-group">' + '<button class="btn btn-danger" id="DeleteRow" type="button">' + '<i class="bi bi-trash"></i> Delete</button>' + '<input type="text" class="form-control date-time" id="avilable_dates" value="'+$('.date-time').val()+'" name="avilable_dates[]" placeholder="Avilable Date" readonly="readonly"></div>';
        $('#newinput').append(newRowAdd);
        // flatpickr(".date-time", {
        //     defaultDate: "today",
        //     enableTime: true,
        // });
    });

    $("body").on("click", "#DeleteRow", function () {
        $(this).parents("#input-group-wrapper").remove();
    });
});
