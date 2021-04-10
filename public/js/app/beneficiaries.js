columnsDataTable = [
    {data: 'document'},
    {data: 'full_name', searchable: false},
    {data: 'sex'},
    {data: 'state', searchable: true, className: 'dt-center', customValue: true},
    {data: 'id', searchable: false, className: 'dt-center', customValue: true},
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
        return value === 'ACTIVO' ? '<span class="m-badge m-badge--success m-badge--wide">' + value + '</span>' : '<span class="m-badge m-badge--danger m-badge--wide">' + value + '</span>';
    } else if (column === 4){
        return (
            '<div>' +
            '<a href="' + crud + '/' + value + '/courses" class="m-portlet__nav-link btn m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--hover-brand" title="Cursos">' +
            '<i class="fa fa-clipboard-list"></i>' +
            '</a>'+
            '<a href="' + crud + '/' + value + '/projects" class="m-portlet__nav-link btn m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--hover-brand" title="Proyectos">' +
            '<i class="fa fa-project-diagram"></i>' +
            '</a>'+
            '</div>'
        );
    }
}

$( function() {
    $("#ethnic_group_form").change( function() {
        if ($(this).val() === "OTROS") {
            $("#other_ethnic_group_form").prop("disabled", false);
        } else {
            $("#other_ethnic_group_form").prop("disabled", true);
        }
    });
});
