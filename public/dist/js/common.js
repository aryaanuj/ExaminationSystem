function renderAjaxDataTable(id, url, columns, columnDefs){
    $(id).DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url:url
        },
        columns:columns,
        columnDefs:columnDefs
    });
}