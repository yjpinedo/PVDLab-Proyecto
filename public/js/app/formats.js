columnsDataTable = [
    {data: 'id'},
    {data: 'name'}
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
    if (column === 3){

    }
}

$('#download').on("click", function () {
    const format_id = $('#id_form').val();
    const beneficiary_id = $('#beneficiary_id_form').val();
    let format = '';

    if (format_id === '1') {
        format = 'format-authorization';
    } else if (format_id === '2') {
        format = 'format-responsibility';
    } else if (format_id === '3') {
        format = 'format-authorization';
    }

    if (beneficiary_id === ""){
        showMessage("Debe seleccionar un beneficiario ", true);
    }else{
        if (format !== '') {
            window.open(`/${format}/${beneficiary_id}`);
        }
    }
});



