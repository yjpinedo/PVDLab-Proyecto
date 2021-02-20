columnsDataTable = [
    {data: 'code'},
    {data: 'name'},
    {data: 'serial'},
    {data: 'pivot', customValue: true},
    {data: 'category.name'},
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
        return value === null ? 0 : value.stock;
    }
}
