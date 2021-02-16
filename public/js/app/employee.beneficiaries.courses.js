columnsDataTable = [
    {data: 'code'},
    {data: 'name'},
    {data: 'teacher.full_name'},
    {data: 'pivot.progress', searchable: false, className: 'dt-center', customValue: true},
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
        if (value === 'INSCRITO'){
            return '<span class="m-badge m-badge--brand m-badge--wide">' + value + '</span>'
        } else if (value === 'FINALIZADO') {
            return '<span class="m-badge m-badge--success m-badge--wide">' + value + '</span>'
        } else {
            return '<span class="m-badge m-badge--warning m-badge--wide">' + "EN " + value + '</span>'
        }
    }
}
