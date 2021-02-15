columnsDataTable = [
    {data: 'code'},
    {data: 'name'},
    {data: 'start'},
    {data: 'translated_concept', searchable: false, className: 'dt-center', customValue: true},
    {data: 'actions', searchable: false, className: 'dt-center', customValue: true},
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
        return '<span class="m-badge m-badge--' + value.class + ' m-badge--wide">' + value.concept + '</span>';
    } else if (column === 4) {
        let actions = '';

        if (value.cancel) {
            actions =
                '<a onclick="concept(' + value.id + ',\'RECHAZADO\')" class="m-portlet__nav-link btn m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--hover-danger" title="Rechazar">' +
                '<i class="fa fa-times"></i>' +
                '</a>'+
                '<a onclick="concept(' + value.id + ',\'APROBADO\')" class="m-portlet__nav-link btn m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--hover-success" title="Aprobar">' +
                '<i class="fa fa-plus"></i>' +
                '</a>'
            ;
        } else if (value.approved) {
            actions =
                '<a onclick="concept(' + value.id + ',\'RECHAZADO\')" class="m-portlet__nav-link btn m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--hover-danger" title="Rechazar">' +
                '<i class="fa fa-times"></i>' +
                '</a>'
            ;
        }

        actions +=
            '<a href="format-project/' + value.id + '/project" target="_blank" onclick="window.open(this.href) return false;" class="m-portlet__nav-link btn m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--hover-info" title="Ver en PDF">' +
            '<i class="fas fa-file-pdf"></i>' +
            '</a>'
        ;

        return actions;
    }
}

$( function() {
    $("#type_form").change( function() {
        if ($(this).val() === "OTRO") {
            $("#other_type_form").prop("disabled", false);
        } else {
            $("#other_type_form").prop("disabled", true);
        }
    });
    $("#origin_form").change( function() {
        if ($(this).val() === "OTRO") {
            $("#other_origin_form").prop("disabled", false);
        } else {
            $("#other_origin_form").prop("disabled", true);
        }
    });
    $("#financing_form").change( function() {
        if ($(this).val() === "SI") {
            $("#financial_entity_form").prop("disabled", false);
        } else {
            $("#financial_entity_form").prop("disabled", true);
        }
    });
});
