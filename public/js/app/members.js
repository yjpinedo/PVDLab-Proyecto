columnsDataTable = [
    {data: 'id'},
    {data: 'full_name'},
    {data: 'sex'},
    {data: 'ethnic_group'},
    {data: 'project.name'},
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
