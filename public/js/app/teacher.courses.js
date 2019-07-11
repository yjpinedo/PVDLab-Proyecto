columnsDataTable = [
    {data: 'code'},
    {data: 'name'},
    {data: 'teacher.full_name'},
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
            '<a href="' + crud + '/' + value + '/beneficiaries" class="m-portlet__nav-link btn m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--hover-brand" title="Beneficiarios">' +
            '<i class="fa fa-users"></i>' +
            '</a>'+
            '<a href="' + crud + '/' + value + '/lessons" class="m-portlet__nav-link btn m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--hover-brand" title="Lecciones">' +
            '<i class="fa fa-list-ul"></i>' +
            '</a>'

        );
    }
}
