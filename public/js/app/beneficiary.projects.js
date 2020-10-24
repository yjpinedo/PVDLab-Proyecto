columnsDataTable = [
    {data: 'code'},
    {data: 'name'},
    {data: 'start'},
    {data: 'type'},
    {data: 'translated_concept', searchable: false, className: 'dt-center', customValue: true},
    {data: 'id', searchable: false, className: 'dt-center', customValue: true},
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
    if (column === 4) {
        return '<span class="m-badge m-badge--' + value.class + ' m-badge--wide">' + value.concept + '</span>';
    }else if (column === 5) {
        return (
            '<div>' +
            '<a href="' + crud + '/' + value + '/members" class="m-portlet__nav-link btn m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--hover-brand" title="Integrantes">' +
            '<i class="fa fa-user"></i>' +
            '</a>' +
            '</div>'
        );
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

