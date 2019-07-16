columnsDataTable = [
    {data: 'code'},
    {data: 'name'},
    {data: 'start'},
    {data: 'translated_concept', searchable: false, className: 'dt-center', customValue: true},
    {data: 'actions', searchable: false, className: 'dt-center', customValue: true},
    //{data: 'id', searchable: false, className: 'dt-center', customValue: true},
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
        }

        return actions
    }
}
