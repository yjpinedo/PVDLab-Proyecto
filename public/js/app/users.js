columnsDataTable = [
    {data: 'id'},
    {data: 'name'},
    {data: 'email'},
    {data: 'active', searchable: false, className: 'dt-center', customValue: true},
    {data: 'role', searchable: false, className: 'dt-center', customValue: true},
];

/**
 * Custom value for status column
 *
 * @param {Number} column - The column number, starting on zero.
 * @param {String} value - The custom value.
 *
 * @returns {String} The HTML string with the status
 */
function getStatus(column, value) {
    if (column === 3) {
        if (value === 1) {
            return '<span class="m-badge m-badge--success m-badge--wide">Activo</span>'
        } else {
            return '<span class="m-badge m-badge--danger m-badge--wide">Inactivo</span>'
        }
    } else if (column === 4) {
        if (value[0] === 'teachers') {
            return '<span class="m-badge m-badge--brand m-badge--wide">' + value + '</span>'
        } else if (value[0] === 'beneficiaries') {
            return '<span class="m-badge m-badge--accent m-badge--wide">' + value + '</span>'
        } else {
            return '<span class="m-badge m-badge--danger m-badge--wide">' + value + '</span>'
        }
    }
}

formTitle.html('Asignar un rol');

$(function () {
    let select = $('#role_id_form');
    let text = '';
    $.get("users/get-roles", function (data) {
        if (data) {
            select.empty();
            select.append($('<option>', {
                value: '',
                text: Lang.get('base/base.placeholder')
            }));
            $.each(data, function (key, value) {
                if (value !== 'admin') {
                    if (value === 'beneficiaries') {
                        text = 'BENEFICIARIO';
                    } else if (value === 'teachers') {
                        text = 'DOCENTE';
                    } else {
                        text = 'EMPLEADO';
                    }
                    select.append($('<option>', {
                        value: key,
                        text: text
                    }));
                }
            });
            select.selectpicker('refresh');
        } else {
            select.append($('<option>', {
                value: '',
                text: Lang.get('base/base.placeholder')
            }));
        }
    });
});

$('#assign').on("click", function () {
    const user_id = $('#user_id_form').val();
    const role = $('#role_id_form').val();
    let formData = new FormData();
    formData.append("user_id", user_id);
    formData.append("role", role);

    if (user_id !== '') {
        if (role !== '') {
            ajaxRequest(crud, formData, routes['create'].method, createRow, formPortlet);
        } else {
            showMessage('Debe seleccionar un rol', true);
        }
    } else {
        showMessage('Debe seleccionar un usuario', true);
    }
});
