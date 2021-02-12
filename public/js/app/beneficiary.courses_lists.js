columnsDataTable = [
    {data: 'code'},
    {data: 'name'},
    {data: 'description'},
    {data: 'state', searchable: false, className: 'dt-center', customValue: true},
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
    if (column === 3) {
        return value === 'DISPONIBLE' ? '<span class="m-badge m-badge--success m-badge--wide">' + value + '</span>' : '<span class="m-badge m-badge--danger m-badge--wide">' + value + '</span>';
    } else if (column === 4){
        return (
            '<a href="' + crud + '/' + value + '/application_course" class="m-portlet__nav-link btn m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--hover-brand" title="Aplicar Curso">' +
            '<i class="fa fa-eye"></i>' +
            '</a>'
        );
    }
}
