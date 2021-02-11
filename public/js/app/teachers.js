columnsDataTable = [
    {data: 'id'},
    {data: 'full_name'},
    {data: 'title', customValue: true},
    {data: 'title_type', customValue: true},
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
        return value === null ? 'SIN DEFINIR, POR FAVOR ACTUALIZAR DATOS' : value;
    } else if (column === 3) {
        return value === null ? 'SIN DEFINIR, POR FAVOR ACTUALIZAR DATOS' : value;
    }
}
