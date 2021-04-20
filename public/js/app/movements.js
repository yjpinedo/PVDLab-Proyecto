columnsDataTable = [
    {data: 'id'},
    {data: 'type'},
    {data: 'warehouse_origin', customValue: true, searchable: false},
    {data: 'warehouse_destination', customValue: true, searchable: false},
    {data: 'created_at', searchable: true, className: 'dt-center'},
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
        return value === null ? 'NO TIENE ALMACÉN DE ORIGEN' : value.name;
    } else if (column === 3) {
        return value === null ? 'NO TIENE ALMACÉN DE DESTINO' : value.name;
    }
}
