$(document).ready(function () {
    if($('#tblCategoriesList').length > 0) {
        let tblCategoriesList = $('#tblCategoriesList');
        let route = config.routes.ajaxIndex;
        let columns = [{ data: 'id' }, { data: 'name' }, { data: 'slug' }, { data: 'actions', className: "text-center" }];
        let targets = [0, 3];
        let order = [0, 'DESC'];
        customDataTable(tblCategoriesList, route, columns, targets, order);
    }

    $(document).on('click', '.deleteRecord', function() {
        let id = $(this).data('id');
        let route = $(this).data('route');
        let tblCategoriesList = $('#tblCategoriesList');
        customSweetAlert(id, route, tblCategoriesList);
    });
});