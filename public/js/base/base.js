$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').prop('content')
    }
});

let crud = window.location.pathname,
    form = $('#form'),
    formButton = $('#formButton'),
    formPortlet = $('#form-portlet'),
    formReset = $('#formReset'),
    formTitle = $('#formTitle'),
    routes = {
        active: {
            url : crud + '/:id',
            method : 'POST'
        },
        create: {
            url : crud,
            method : 'POST'
        },
        data: {
            url : crud,
            method : 'GET'
        },
        delete: {
            url : crud + '/:id',
            method : 'DELETE'
        },
        select: {
            url : '/select',
            method : 'GET'
        },
        show: {
            url : crud + '/:id',
            method : 'GET'
        },
        status: {
            url : crud + '/status',
            method : 'POST'
        },
        update: {
            url : crud + '/:id',
            method : 'PUT'
        }
    },
    table = $('#table'),
    tablePortlet = $('#table-portlet'),
    title = formTitle.attr('data-title');

function ajaxRequest(url, data, method, callback, element) {
    if (crud.indexOf('edit') !== -1) {
        url = url.replace('/edit/undefined', '');
    }
    block(element);
    if(method === 'PUT'){
        method = 'POST';
        data.append('_method', 'PUT');
    } else if(method === 'DELETE') {
        method = 'POST';
        if(data === null){
            data = new FormData();
            data.append('_method', 'DELETE');
        }
    }

    $.ajax({
        url: url,
        data: data,
        dataType: "json",
        method: method,
        processData: false,
        contentType: false,
        success: function (results) {
            $('#validations').addClass('m--hide');
            callback(results);
        },
        error: function(results){
            if(results.status === 422){
                showValidations(results.responseJSON.errors);
            }
        },
        fail: function (results) {
            showMessage(results, true);
        },
        complete: function(){
            unblock(element);
        }
    });
}

function block(element){
    mApp.block(element, {});
}
function disableForm(disabled = true, buttons = disabled) {
    form.find('input, textarea').prop('disabled', disabled);
    form.find('.only-view').prop('readonly', true);
    form.find('.switch').bootstrapSwitch('readonly', disabled);
    form.find('button').prop('disabled', disabled);
    formButton.prop('disabled', buttons);
    formReset.prop('disabled', buttons);
}

formButton.on("click", function () {
    let id = $('#id_form').val();
    let action = formButton.attr('data-action');
    let formData = new FormData(form[0]);

    if (action === 'create' || action === 'creating') {
        ajaxRequest(crud.replace('/create', ''), formData, routes['create'].method, createRow, formPortlet);
    } else if (action === 'show') {
        disableForm(false);
        $('#form .form-group:first .form-control').focus();
        if (crud === '/courses' || crud === '/teacher/courses' || crud === '/employee/courses') {
            $('#format_slug_form').hide();
            $('label[for=format_slug_form]').hide();
        }
        formReset.removeClass("m--hide");
        formTitle.html(Lang.get('base/base.titles.update', {name: formTitle.attr('data-name')}));
        formButton.html(Lang.get('base/base.buttons.update')).attr('data-action', 'update');
        if (crud === '/formats' || crud === '/employee/formats') {
            formButton.html('Descargar');
        } else if (crud === '/users') {
            formButton.html('Asignar Rol');
        }
    } else {
        let url = routes['update'].url.replace(':id', id);
        ajaxRequest(url, formData, routes['update'].method, createRow, formPortlet);
    }
});

formReset.on("click", function () {
    let action = formButton.attr('data-action');

    if (action === 'update') {
        show($('#id_form').val());
        if (crud === '/courses' || crud === '/teacher/courses' || crud === '/employee/courses') {
            $('#format_slug_form').show();
            $('label[for=format_slug_form]').show();
        }
    } else if (action === 'creating' && table.length === 0) {
        window.location.href = "/home";
    } else {
        if (crud === '/courses' || crud === '/teacher/courses' || crud === '/employee/courses') {
            $('#format_slug_form').show();
            $('label[for=format_slug_form]').show();
        }
        dataTable.rows().deselect();
        resetForm('creating');
    }
});

function resetForm(action = 'create', name) {
    $('#id_form').val(0);
    form[0].reset();

    if (action === 'create') {
        disableForm(false);
        action = 'creating';
        formReset.removeClass("m--hide");
        formTitle.html(Lang.get('base/base.titles.create'));
    } else if (action === 'creating') {
        disableForm(true, true);
        formReset.removeClass("m--hide");
        formTitle.html(null);
    } else if (action === 'show') {
        disableForm(true, false);
        formReset.addClass("m--hide");
        if (crud !== '/formats' && crud !== '/employee/formats') {
            formTitle.html(Lang.get('base/base.titles.show', {name: name})).attr('data-name', name);
        } else {
            disableForm(false, false);
            formTitle.html('Selecciona Beneficiario');
        }
    }

    formButton.html(Lang.get('base/base.buttons.' + action)).attr('data-action', action);
    if (crud === '/formats' || crud === '/employee/formats') {
        formButton.html('Descargar').attr('data-action', 'create').attr('id', 'download');
    }
    $('span[name=form-error]').remove();
    $('#validations').addClass('m--hide');
    form.find('select').selectpicker('refresh');
}

function showMessage(message, error = false) {
    if (error) toastr.error(message);
    else toastr.success(message);
}

function showValidations(errors) {
    $('#validations').removeClass('m--hide');
    $('span[name=form-error]').remove();

    for (let error in errors) {
        if (errors.hasOwnProperty(error)) {
            $('#' + error + '_form').parents('div .form-group').append('<span class="m--font-danger" name="form-error">' + errors[error] + '</span>')
        }
    }
}

function unblock(element){
    mApp.unblock(element, {});
}

//Init select picker
$(".m_selectpicker").selectpicker();

//Init date picker
$('.datepicker').datepicker({
    autoclose: true,
    format : "yyyy-mm-dd",
});

$('.yyyy-mm').datepicker({
    autoclose: true,
    format : "yyyy-mm",
    minViewMode: 1
});

//Init wizard
let wizard = new mWizard('m_wizard', {
    startStep: 1
});

$('.m-wizard__step-number').on('click', function() {
    let step = $(this).children().html();
    try { wizard.goTo(step); } catch (e){}
});

$('.select-reload').on('click', function() {
    dataSelect($(this));
});

$('#picture_form').on('change', function(){
    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#preview')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(this.files[0]);
    }
});

function dataSelect(reload) {
    if (crud === '/articles/create') {
        ajaxRequest('/select?id=category_id_form&name=category_id', null, 'GET', reloadSelect, formPortlet);
    } else if (crud === '/loans/create') {
        ajaxRequest('/select?id=beneficiary_id_form&name=beneficiary_id', null, 'GET', reloadSelect, formPortlet);
        ajaxRequest('/select?id=article_id_form&name=article_id', null, 'GET', reloadSelect, formPortlet);
    } else if (crud === '/beneficiary/loans/create') {
        ajaxRequest('/select?id=article_id_form&name=article_id', null, 'GET', reloadSelect, formPortlet);
    } else {
        let select = reload.parent().siblings('div').children('select');
        let url = routes['select'].url + '?id=' + select.attr('id') + '&name=' + select.attr('name');
        ajaxRequest(url, null, routes['select'].method, reloadSelect, formPortlet);
    }
}

function reloadSelect(results) {
    let select =  $('#' + results.id);
    select.empty();
    select.append($('<option>', {
        value: '',
        text : Lang.get('base/base.placeholder')
    }));
    $.each(results.data, function(key, value) {
        if (results.name === 'user_id'){
            if (key !== '1') {
                select.append($('<option>', {
                    value: key,
                    text : value
                }));
            }
        } else {
            select.append($('<option>', {
                value: key,
                text : value
            }));
        }
    });
    select.selectpicker('refresh');
}

function state(id, next) {
    let formData = new FormData();
    formData.append('state', next);
    formData.append('id', id);

    let url = routes.update.url.replace('/:id', '');
    ajaxRequest(url, formData, routes.update.method, createRow, tablePortlet);
}

function concept(id, next) {
    let formData = new FormData();
    formData.append('concept', next);
    formData.append('id', id);

    let url = routes.update.url.replace('/:id', '');
    ajaxRequest(url, formData, routes.update.method, createRow, tablePortlet);
}
function assistance_list(id, next) {
    let formData = new FormData();
    formData.append('assistance', next);
    formData.append('id', id);

    let url = routes.update.url.replace('/:id', '');
    ajaxRequest(url, formData, routes.update.method, createRow, tablePortlet);
}

$(document).ready( function () {
    $('li.m-menu__item > div > ul > li.m-menu__item--active').parents('li.m-menu__item').addClass('m-menu__item--open m-menu__item--expanded');

    $('.select-reload').each(function() {
        dataSelect($(this));
    });

    //Init bootstrap switch
    $('.switch').bootstrapSwitch();
    if (form.length !== 0){
        if (crud === '/articles/create' || crud.indexOf('edit') || crud === '/loans/create') {
            disableForm(false, false);
        } else {
            disableForm(true);
        }
    }
    if (table.length === 0) ajaxRequest(routes.data.url, null, routes.data.method, show, formPortlet);
});
