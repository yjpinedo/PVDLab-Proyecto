columnsDataTable = [
    {data: 'id'},
    {data: 'full_name'},
    {data: 'sex'},
    {data: 'ethnic_group'},
    {data: 'translated_assistance', searchable: false, className: 'dt-center', customValue: true},
    {data: 'translated_assistance', searchable: false, className: 'dt-center', customValue: true},
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
    if  (column === 4) {
        if (isAssistance(value)) {
            value.class = 'success';
            value.assistance = 'ASISTIÓ';
        } else {
            value.assistance = 'NO ASISTIÓ'
            value.class = 'danger';
        }
            return '<span class="m-badge m-badge--' + value.class + ' m-badge--wide">' + value.assistance + '</span>';

    } else if (column === 5) {
        if (isAssistance(value)) {
            return (
                '<a onclick="action(' + value.id + ', \'create\')" class="m-portlet__nav-link btn m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--hover-brand" title="Quitar Asistencia">' +
                '<i class="fa fa-user-times"></i>'
            );
        } else {
            return (
                '<a onclick="action(' + value.id + ', \'create\')" class="m-portlet__nav-link btn m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--hover-brand" title="Tomar Asistencia">' +
                '<i class="fa fa-user-check"></i>'
            );
        }
    }
}

function isAssistance(value) {
    let pathname = window.location.pathname;
    return value.lessons.indexOf(pathname.split('/')[5]) !== -1;
}

function action (value, method) {
    let formData = new FormData();
    formData.append('beneficiary_id', value);
    ajaxRequest(routes[method].url, formData, routes[method].method, assistance, formPortlet);
}

function assistance(results) {
    const {assistance, error, id, message, translated_assistance} = results;
    let icon;

    if (message) showMessage(message, !!error);

    $('#' + id + ' > td:nth-child(5)').html('<span class="m-badge m-badge--' + translated_assistance.class + ' m-badge--wide">' + translated_assistance.assistance + '</span>');

    if (assistance) {
        icon = '<a onclick="action(' + id + ', \'create\')" class="m-portlet__nav-link btn m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--hover-brand" title="Quitar Asistencia">' +
            '<i class="fa fa-user-times"></i>';
    } else {
        icon = '<a onclick="action(' + id + ', \'create\')" class="m-portlet__nav-link btn m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--hover-brand" title="Tomar Asistencia">' +
            '<i class="fa fa-user-check"></i>';
    }

    $('#' + id + ' > td:nth-child(6)').html(icon)
    $('#' + id).next('.child').children('.child').children('ul').children('li').children('span.dtr-data').html(icon);
}
