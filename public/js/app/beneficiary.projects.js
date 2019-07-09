columnsDataTable = [
    {data: 'code'},
    {data: 'name'},
    {data: 'start'},
    {data: 'type'},
    {data: 'translated_concept', searchable: false, className: 'dt-center', customValue: true},
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
    }
}
