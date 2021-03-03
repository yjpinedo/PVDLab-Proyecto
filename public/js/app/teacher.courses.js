columnsDataTable = [
    {data: 'code'},
    {data: 'name'},
    {data: 'state', searchable: true, className: 'dt-center', customValue: true},
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
    if (column === 2) {
        return value === 'DISPONIBLE' ? '<span class="m-badge m-badge--success m-badge--wide">' + value + '</span>' : '<span class="m-badge m-badge--danger m-badge--wide">' + value + '</span>';
    } else if (column === 3){
        return (
            '<a href="' + crud + '/' + value + '/beneficiaries" class="m-portlet__nav-link btn m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--hover-brand" title="Beneficiarios">' +
            '<i class="fa fa-users"></i>' +
            '</a>'+
            '<a href="' + crud + '/' + value + '/lessons" class="m-portlet__nav-link btn m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--hover-brand" title="Lecciones">' +
            '<i class="fa fa-list-ul"></i>' +
            '</a>'

        );
    }
}
