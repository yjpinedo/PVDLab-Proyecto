function active(id, active) {
    let formData = new FormData();
    let url = routes.active.url.replace(':id', id);

    formData.append('active', active);
    ajaxRequest(url, formData, routes.active.method, createRow, formPortlet);
}

function create() {
    if (crud !== '/articles' && crud !== '/loans') {
        resetForm();
        $('#form .form-group:first .form-control').focus();
        dataTable.rows().deselect();
    } else if (crud === '/loans') {
        window.location.href = '/loans/create';
    } else {
        window.location.href = '/articles/create';
    }
}

function createRow(results) {
    if (results === undefined) results = {};

    if (table.length !== 0) dataTable.ajax.reload();
    console.log(crud);
    console.log(crud === '/loans/create');
    if (crud === '/loans') {
    } else if (form.length !== 0 && crud.indexOf('create') === -1 && crud.indexOf('edit') === -1) {
        if (results.data) showEntity(results.data);
        else resetForm('creating');
    } else if (crud === '/loans/create'){
        window.location.href = '/loans';
    } else {
        window.location.href = '/articles';
    }

    if (results.message) showMessage(results.message, !!results.error);

    if (results.reload) location.reload();
}
