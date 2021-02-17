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
    const loan_id = $('#loan_id_form').val();
    let url = '';

    if (format_id === '1') {
        url = `/employee/format-authorization/${beneficiary_id}`;
    } else if (format_id === '2') {
        url = `/employee/format-responsibility/${beneficiary_id}`;
    } else if (format_id === '3') {
        url = `/employee/format-loan/${beneficiary_id}/${loan_id}/loan`;
    }

    if (beneficiary_id === ""){
        showMessage("Debe seleccionar un beneficiario ", true);
    }else{
        if (url !== '') {
            window.open(url);
        }
    }
});

$(function() {
    $('#loan_id_form').prop('disabled', true);
    let cont = 0;
   dataTable.on('key-focus', function (e, table, cell) {
       if (table.$('tr.selected').attr('id') === '3') {
           cont = 0;
           $('#download').hide();
           $('#loan_id_form').empty().append('<option value="">Seleccione un opción</option>');
           $("#beneficiary_id_form").change( function() {
               if (cont === 0) {
                   $.get('format-loans-beneficiaries', { beneficiary_id : $(this).val() }, function (loans){
                       if (loans.data){
                           $('#loan_id_form').prop('disabled', false).empty().append('<option value="">Seleccione un opción</option>').selectpicker('refresh');
                           $.each(loans.data, function (index, value) {
                                $('#loan_id_form').append('<option value="' + value.id + '">' + value.name + '</option>').selectpicker('refresh');
                           });
                           if ($('#loan_id_form option').length > 1) {
                               $('#download').show();
                           } else {
                               $('#download').hide();
                           }
                       } else {
                           $('#loan_id_form').prop('disabled', true).empty().append('<option value="">Seleccione un opción</option>').selectpicker('refresh');
                           $('#download').hide();
                           showMessage(loans.message, true);
                       }
                       cont = 0;
                   });
               }
               cont++;
           });
       } else {
           $('#download').show();
           $('#loan_id_form').prop('disabled', true).empty().append('<option value="">Seleccione un opción</option>').selectpicker('refresh');
           cont++;
       }
    });
});



