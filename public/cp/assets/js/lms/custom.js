var csrf_token = $('meta[name="csrf-token"]').attr('content');

// Common Datatable for all
function customDataTable(dTable, route, columns, targets, order) {
    dTable.DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        paging: true,
        scrollX: true,
        ajax: {
            url: route,
            dataType: 'json',
            type: 'POST',
            data: { 
                "_token": csrf_token,
            }
        },
        columns: columns,
        columnDefs: [{
            searchable: false,
            orderable: false,
            targets: targets,
        }],
        order: [order],
        drawCallback: function(settings) {
            feather.replace();
        },
        fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {  
            const count = dTable.dataTable().fnSettings().fnRecordsDisplay();
            const pageOffset = dTable.dataTable().fnSettings()._iDisplayStart;
            $('td:first', nRow).html(count - pageOffset - iDisplayIndex);
            return nRow;
        },
    });
}

// Datatable delete record using ajax
function customSweetAlertDataTable(id, route, dTable) {
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
            $.ajax({
                url: route,
                dataType: 'json',
                type: 'DELETE',
                data: {
                    "id": id,
                    "_token": csrf_token,
                },
                success: function (response) {
                    dTable.DataTable().ajax.reload();
                    (response.status) ? swalWithBootstrapButtons.fire('Deleted!', response.message, 'success')
                                    : swalWithBootstrapButtons.fire('Error!', response.message, 'error');
                },
                error: function(response, status, err) {
                    swalWithBootstrapButtons.fire('Cancelled', response.message, 'error');
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire('Cancelled', 'Delete is cancelled.', 'error');
        }
    });
}

// Image delete using ajax
function customSweetAlert(id, route, wrapper) {
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
            $.ajax({
                url: route,
                dataType: 'json',
                type: 'DELETE',
                data: {
                    "id": id,
                    "_token": csrf_token,
                },
                success: function (response) {
                    wrapper.remove();
                    (response.status) ? swalWithBootstrapButtons.fire('Deleted!', response.message, 'success')
                                    : swalWithBootstrapButtons.fire('Error!', response.message, 'error');
                },
                error: function(response, status, err) {
                    swalWithBootstrapButtons.fire('Cancelled', response.message, 'error');
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire('Cancelled', 'Delete is cancelled.', 'error');
        }
    });
}

if ($('.description').length) {
    tinymce.init({
        selector: '.description',
        resize: false,
        statusbar : false,
        menubar: false,
        height : "250",
        plugins: [
            'advlist', 'autoresize', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'pagebreak',
            'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'code', 'table',
        ],
        toolbar1: 'undo redo | insert | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor emoticons | codesample | table | preview',
    });
}

if($('.numberonly').length) {
    $('.numberonly').keypress(function (e) {
        var charCode = (e.which) ? e.which : e.keyCode
        if (String.fromCharCode(charCode).match(/[^0-9]/g)) {
            return false;
        }
    });
}

function displayMessage(message, icon = 'success') {
    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
    });
    Toast.fire({
        icon: icon,
        title: message
    });
}

$(document).ready(function(e){
    if($('p.mt-1.tx-13.text-danger').length > 0){
        $("p.mt-1.tx-13.text-danger").each(function(ev) {
          if($(this).text() != ''){
            $(this).addClass('label-danger');
          }
        });
    }
});