columnsDataTable = [
    {data: 'code'},
    {data: 'name'},
    {data: 'serial'},
    {data: 'category.name'},
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
    if (column === 4) {
        return (
            '<a href="' + crud + '/' + value + '/warehouse" class="m-portlet__nav-link btn m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--hover-brand" title="Lista de Almacén">' +
            '<i class="fa fa-clipboard-check"></i>' +
            '</a>' +
            '<a href="' + crud + '/' + value + '/edit" class="m-portlet__nav-link btn m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--hover-brand" title="Editar">' +
            '<i class="fa fa-edit"></i>' +
            '</a>'
        );
    }
}
