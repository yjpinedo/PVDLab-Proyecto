function active(id, active) {
    let formData = new FormData();
    let url = routes.active.url.replace(':id', id);

    formData.append('active', active);
    ajaxRequest(url, formData, routes.active.method, createRow, formPortlet);
}

function create() {
    if (crud !== '/articles' && crud !== '/loans' && crud !== '/beneficiary/loans') {
        resetForm();
        $('#form .form-group:first .form-control').focus();
        if (crud === '/courses' || crud === '/teacher/courses' || crud === '/employee/courses') {
            $('#format_slug_form').hide();
            $('label[for=format_slug_form]').hide();
        }
        dataTable.rows().deselect();
    } else if (crud === '/beneficiary/loans') {
        window.location.href = '/beneficiary/loans/create';
    } else if (crud === '/loans') {
        window.location.href = '/loans/create';
    } else {
        window.location.href = '/articles/create';
    }
}

function createRow(results) {
    if (results === undefined) results = {};

    if (table.length !== 0) dataTable.ajax.reload();
    if (crud === '/loans' || crud === '/employee/loans' || crud === '/users' || crud.indexOf('/employee/beneficiaries/*/projects') === -1 && crud !== '/employee/courses') {
        if (crud === '/employee/update-password' || crud === '/beneficiary/update-password') {
            $('span[name=form-error]').remove();
            form[0].reset();
        }
    } else if (form.length !== 0 && crud.indexOf('create') === -1 && crud.indexOf('edit') === -1) {
        if (results.data) {
            showEntity(results.data);
            if (crud === '/courses' || crud === '/teacher/courses' || crud === '/employee/courses') {
                $('#format_slug_form').show();
                $('label[for=format_slug_form]').show();
            }
        } else {
            resetForm('creating');
        }
    } else if (crud === '/loans/create'){
        window.location.href = '/loans';
    } else if (crud === '/beneficiary/loans/create'){
        window.location.href = '/beneficiary/loans/';
    } else {
        window.location.href = '/articles';
    }

    if (results.message) showMessage(results.message, !!results.error);

    if (results.reload) location.reload();
}
