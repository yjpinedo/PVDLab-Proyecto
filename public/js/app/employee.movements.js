columnsDataTable = [
    {data: 'id'},
    {data: 'type'},
    {data: 'warehouse_origin', customValue: true},
    {data: 'warehouse_destination', customValue: true},
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
    if (column === 2){
        return value === null ? 'NO TIENE ALMACÉN DE ORIGEN' : value.name;
    } else if (column === 3) {
        return value === null ? 'NO TIENE ALMACÉN DE DESTINO' : value.name;
    }
}
