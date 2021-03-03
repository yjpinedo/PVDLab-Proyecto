columnsDataTable = [
    {data: 'id'},
    {data: 'full_name', searchable: false},
    {data: 'sex'},
    {data: 'position.full_name', customValue: true, searchable: false},
    {data: 'name', visible: false},
    {data: 'last_name', visible: false},
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
        return value === undefined ? 'SIN DEFINIR, POR FAVOR ACTUALIZAR DATOS' : value;
    }
}
