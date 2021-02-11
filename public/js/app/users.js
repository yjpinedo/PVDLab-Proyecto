columnsDataTable = [
    {data: 'id'},
    {data: 'name'},
    {data: 'email'},
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

}
formTitle.html('Asignar un rol');

$(function (){
    let select =  $('#role_id_form');
    $.get("users/get-roles", function (data) {
        if (data) {
            select.empty();
            select.append($('<option>', {
                value: '',
                text : Lang.get('base/base.placeholder')
            }));
            $.each(data, function(key, value) {
                if (value === 'teachers' || value === 'employees') {
                    select.append($('<option>', {
                        value: key,
                        text : value.toUpperCase()
                    }));
                }
            });
            select.selectpicker('refresh');
        } else {
            select.append($('<option>', {
                value: '',
                text : Lang.get('base/base.placeholder')
            }));
        }
    });
});

$('#assign').on("click", function () {
    const beneficiary_id = $('#beneficiary_id_form').val();
    const role = $('#role_id_form').val();
    let formData = new FormData();
    formData.append("beneficiary_id", beneficiary_id);
    formData.append("role", role);

    if (beneficiary_id !== ''){
        if (role !== '') {
            ajaxRequest(crud, formData, routes['create'].method, createRow, formPortlet);
        } else {
            showMessage('Debe seleccionar un rol', true);
        }
    } else {
        showMessage('Debe seleccionar un beneficiario', true);
    }
});
