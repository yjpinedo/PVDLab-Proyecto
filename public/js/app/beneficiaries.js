columnsDataTable = [
    {data: 'document'},
    {data: 'full_name', searchable: false},
    {data: 'sex'},
    //{data: 'state', searchable: true},
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
        return (
            '<div>' +
            '<a href="' + crud + '/' + value + '/courses" class="m-portlet__nav-link btn m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--hover-brand" title="Cursos">' +
            '<i class="fa fa-clipboard-list"></i>' +
            '</a>' +
            '<a href="' + crud + '/' + value + '/projects" class="m-portlet__nav-link btn m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--hover-brand" title="Proyectos">' +
            '<i class="fa fa-project-diagram"></i>' +
            '</a>' +
            '</div>'
        );
    }
}

$(function () {
    $("#ethnic_group_form").change(function () {
        if ($(this).val() === "OTROS") {
            $("#other_ethnic_group_form").prop("disabled", false);
        } else {
            $("#other_ethnic_group_form").prop("disabled", true);
        }
    });
});
