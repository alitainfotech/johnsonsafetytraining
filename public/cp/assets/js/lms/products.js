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

//    $("#rowAdder").click(function () {

//         newRowAdd = '<div class="mb-3" id="input-group-wrapper">' + '<div class="input-group">' + '<button class="btn btn-danger" id="DeleteRow" type="button">' + '<i class="bi bi-trash"></i> Delete</button>' + '<input type="text" class="form-control date-time" id="avilable_dates" value="'+$('.date-time').val()+'" name="avilable_dates[]" placeholder="Avilable Date" readonly="readonly"></div>';
//         $('#newinput').append(newRowAdd);
//         // flatpickr(".date-time", {
//         //     defaultDate: "today",
//         //     enableTime: true,
//         // });
//     });

    $("body").on("click", "#DeleteRow", function () {
        $(this).parents("#input-group-wrapper").remove();
    });

    
});

var btn_delete = '<button type="button" class="btn btn-danger" onclick="removeKolom($(this))">Delete</button>';
    var btn_add = '<button class="add-btn-repeat btn btn-primary" onclick="addElement($(this))" type="button">Add</button>';

    // flatpickr(".date-time", {
    //     defaultDate: "today",
    //     enableTime: true,
    // });
    function removeKolom(e) {
        e.parents('.kolom').remove();

        $('.end_date').each(function(i){
            $(this).attr('name','courses['+i+'][end_date]');
            $(this).attr('id','end_date_'+i); 
            $(this).attr('data-id',i); 
        });

        $('.start_date').each(function(i){
            $(this).attr('name','courses['+i+'][start_date]');
        });

        $('.no_of_seat').each(function(i){
            $(this).attr('name','courses['+i+'][no_of_seat]');
        });

        $('input[type="checkbox"]').each(function(i){
            $(this).attr('data-id',i); 
        });

    }

    function addElement(e) {
    var newElement = $(".kolom").first().clone();
        var num = $('.kolom').length;
        var newNum = num;
        var newNums = 0;
        newElement.find('.end_date').each(function(i){
            $(this).attr('name','courses['+newNum+'][end_date]');
            $(this).attr('id','end_date_'+newNum); 
            $(this).prop('disabled', true);
            $(this).attr('data-id',newNum); 
        });

        newElement.find('.start_date').each(function(i){
            $(this).attr('name','courses['+newNum+'][start_date]');
        });

        newElement.find('.no_of_seat').each(function(i){
            $(this).attr('name','courses['+newNum+'][no_of_seat]');
        });

        newElement.find('input[type="checkbox"]').each(function(i){
            $(this).prop('checked',false); 
            $(this).attr('data-id',newNum); 
        });
        $(".kolom").find('button.add-btn-repeat').replaceWith(btn_delete);
        newElement.appendTo(".data-repeater").find('button').replaceWith(btn_add);

        
        flatpickr(".date-time", {
            defaultDate: "today",
            enableTime: true,
        });

        $(".enable-end-date").on('click', function() {
            var dataId = $(this).data('id');
            if($(this).is(":checked")){
                $('#end_date_'+dataId).prop('disabled', false);
            }
            else{
                $('#end_date_'+dataId).prop('disabled', true);
            }
        });

    }


    $(".enable-end-date").on('click', function() {
        var dataId = $(this).data('id');
        if($(this).is(":checked")){
            $('#end_date_'+dataId).prop('disabled', false);
        }
        else{
            $('#end_date_'+dataId).prop('disabled', true);
        }
    });
