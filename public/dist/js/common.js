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

function confirmBox(title,text,confirmButtonText,icon='success',redirectUrl=''){
    Swal.fire({
        title: title,
        icon: icon,
        text:text,
        showCancelButton: true,
        confirmButtonText: confirmButtonText
      }).then((result) => {
        if (result.isConfirmed) {
            if(redirectUrl){
                $('#delete-form').attr('action',redirectUrl);
                $('#delete-form').submit();
            }
        } 
      })
}