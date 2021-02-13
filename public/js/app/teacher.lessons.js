columnsDataTable = [
    {data: 'id'},
    {data: 'date'},
    {data: 'course.name'},
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

    if (column === 3){
        return (
            '<a href="' + crud + '/' + value + '/take_assistance" class="m-portlet__nav-link btn m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--hover-brand" title="Tomar Asistencia">' +
            '<i class="fa fa-user-check"></i>' +
            '</a>'
        );
    }
}
