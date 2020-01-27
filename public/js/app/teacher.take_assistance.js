columnsDataTable = [
    {data: 'id'},
    {data: 'full_name'},
    {data: 'sex'},
    {data: 'ethnic_group'},
    //{data: 'assistance_value', searchable: false, className: 'dt-center', customValue: true},
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
            '<a onclick="action(' + value + ')" class="m-portlet__nav-link btn m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--hover-brand" title="Tomar Asistencia" data-action="create">' +
            '<i class="fa fa-clipboard-check"></i>'
        );
    }
}

function action (value) {
    let formData = new FormData();
    formData.append('beneficiary_id', value);

    ajaxRequest(routes['create'].url, formData, routes['create'].method, assistance, formPortlet);
}

function assistance(results) {

   if (results.message) showMessage(results.message, !!results.error);

    if (results.location) location.href = results.location;
}
