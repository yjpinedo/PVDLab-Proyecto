$('#apply').on("click", function () {
    ajaxRequest(routes['create'].url, null, routes['create'].method, application, formPortlet);
});

function application(results) {

    if (results.message) showMessage(results.message, !!results.error);

    if (results.location) location.href = results.location;
}



