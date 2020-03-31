columnsDataTable = [
    {data: 'code'},
    {data: 'name'},
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
        return (
            '<div>' +
            '<a href="' + crud + '/' + value + '/articles" class="m-portlet__nav-link btn m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--hover-brand" title="Artículos">' +
            '<i class="fa fa-clipboard-check"></i>' +
            '</a>'
        );
    }
}
