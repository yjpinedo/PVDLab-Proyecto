columnsDataTable = [
    {data: 'id'},
    {data: 'full_name'},
    {data: 'employee.full_name'},
    {data: 'created_at', searchable: true, className: 'dt-center'},
    {data: 'translated_state', searchable: false, className: 'dt-center', customValue: true},
    {data: 'id', searchable: false, className: 'dt-center', customValue: true},
    {data: 'state', searchable: true, visible: false},
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
        return (
            '<div>' +
            '<a href="' + crud + '/' + value + '/article" class="m-portlet__nav-link btn m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--hover-brand" title="Ver Artículos">' +
            '<i class="fas fa-list-ol"></i>' +
            '</a>' +
            '</div>'
        );
    }
}
