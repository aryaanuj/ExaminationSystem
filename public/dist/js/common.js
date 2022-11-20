function renderAjaxDataTable(id, url, columns){
    $(id).DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url:url
        },
        columns:columns,
    });
}