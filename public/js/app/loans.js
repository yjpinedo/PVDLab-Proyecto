columnsDataTable = [
    {data: 'id'},
    {data: 'employee.full_name'},
    {data: 'beneficiary.full_name'},
    {data: 'refund'},
    {data: 'translated_state', searchable: false, className: 'dt-center', customValue: true},
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
    if (column === 4) {
        return '<span class="m-badge m-badge--' + value.class + ' m-badge--wide">' + value.state + '</span>';
    } else if (column === 5) {
        let actions = '';

        if (value.cancel) {
            actions =
                '<a onclick="state(' + value.id + ',\'RECHAZADO\')" class="m-portlet__nav-link btn m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--hover-danger" title="Rechazar">' +
                '<i class="fa fa-times"></i>' +
                '</a>'+
                '<a onclick="state(' + value.id + ',\'APROBADO\')" class="m-portlet__nav-link btn m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--hover-success" title="Aprobar">' +
                '<i class="fa fa-plus"></i>' +
                '</a>'
            ;
        } else if (value.approved) {
            actions =
                '<a onclick="state(' + value.id + ',\'RECHAZADO\')" class="m-portlet__nav-link btn m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--hover-danger" title="Rechazar">' +
                '<i class="fa fa-times"></i>' +
                '</a>'
            ;
        }
        actions +=
            '<a href="' + crud + '/' + value.id + '/article" class="m-portlet__nav-link btn m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--hover-brand" title="Lista de artículos">' +
            '<i class="fa fa-clipboard-check"></i>' +
            '</a>';

        return actions;
    }
}
