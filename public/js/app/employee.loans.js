columnsDataTable = [
    {data: 'id'},
    {data: 'name'},
    {data: 'employee', customValue: true},
    {data: 'beneficiary.full_name'},
    {data: 'refund', className: 'dt-center'},
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
    if (column === 2) {
        console.log(column);
        return value === null ? 'NO SE ASIGNO NINGUN EMPLEADO' : value.full_name;
    } else if (column === 5) {
        return '<span class="m-badge m-badge--' + value.class + ' m-badge--wide">' + value.state + '</span>';
    } else if (column === 6) {
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
            '<a href="format-loan/' + value.beneficiary_id + '/' + value.id + '/loan" target="_blank" onclick="window.open(this.href) return false;" class="m-portlet__nav-link btn m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--hover-info" title="Ver en PDF">' +
            '<i class="fas fa-file-pdf"></i>' +
            '</a>' +
            '<a href="' + crud + '/' + value.id + '/article" class="m-portlet__nav-link btn m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--hover-brand" title="Ver artículos">' +
            '<i class="fa fa-list-ul"></i>' +
            '</a>'
        ;
        return actions;
    }
}
