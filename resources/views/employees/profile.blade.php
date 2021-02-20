@extends('layouts.app')

@section('title', __('app.titles.profile'))

@section('content')
    <div class="col-xl-12">
        <div class="m-portlet" id="form-portlet" style="">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text m--font-brand">Actualizar perfil</h3>
                    </div>
                </div>
            </div>
            <div class="m-wizard m-wizard--2 m-wizard--brand m-wizard--step-first" id="m_wizard">
                <div class="m-wizard__head" style="margin:2rem 0 0 0; padding: 0 2.2rem">
                    <div class="m-wizard__progress">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                        </div>
                    </div>
                    <div class="m-wizard__nav">
                        <div class="m-wizard__steps">
                            <div class="m-wizard__step m-wizard__step--current" m-wizard-target="m_wizard_form_step_1">
                                <a href="javascript:" class="m-wizard__step-number">
                                    <span style="width: 3rem; height: 3rem; margin:-4.5rem auto 0 auto; color:#fff; font-weight:bold">1</span>
                                </a>
                            </div>
                            <div class="m-wizard__step" m-wizard-target="m_wizard_form_step_2">
                                <a href="javascript:" class="m-wizard__step-number">
                                    <span style="width: 3rem; height: 3rem; margin:-4.5rem auto 0 auto; color:#fff; font-weight:bold">2</span>
                                </a>
                            </div>
                            <div class="m-wizard__step" m-wizard-target="m_wizard_form_step_3">
                                <a href="javascript:" class="m-wizard__step-number">
                                    <span style="width: 3rem; height: 3rem; margin:-4.5rem auto 0 auto; color:#fff; font-weight:bold">3</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="validations" class="m-portlet__padding-x m--hide">
                    <div class="m-alert m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>¡Alerta!</strong> Hay errores de validación en el formulario.
                    </div>
                </div>
                <div class="m-wizard__form">
                    <form method="POST" action="#" accept-charset="UTF-8" class="m-form" id="form">
                        @csrf
                        <input id="id_form" name="id" type="hidden" value="{{ $employee->id }}">
                        <div class="m-portlet__body m--padding-10">
                            <div class="m-wizard__form-step m-wizard__form-step--current" id="m_wizard_form_step_1">
                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group col-12">
                                        <h5>Información Personal</h5>
                                    </div>
                                    <div class="form-group m-form__group col-12">
                                        <label for="document_type_form">Tipo de Documento</label>
                                        <select id="document_type_form" class="form-control m-bootstrap-select m_selectpicker" name="document_type" tabindex="-98">
                                            <option selected="selected" value="">Seleccione una opción</option>
                                            <option value="CÉDULA DE CIUDADANÍA" {{ old('document_type') == $employee->document_type || in_array($employee->document_type, __('app.selects.person.document_type')) ? 'selected' : "" }}>CÉDULA DE CIUDADANÍA</option>
                                            <option value="CÉDULA DE EXTRANJERÍA" {{ old('document_type') == $employee->document_type || in_array($employee->document_type, __('app.selects.person.document_type')) ? 'selected' : "" }}>CÉDULA DE EXTRANJERÍA</option>
                                        </select>
                                    </div>
                                    <div class="form-group m-form__group col-12">
                                        <label for="document_form">Documento</label>
                                        <input id="document_form" class="form-control m-input" autocomplete="off" name="document" type="text" value="{{ old('document', $employee->document) }}">
                                    </div>
                                    <div class="form-group m-form__group col-12">
                                        <label for="expedition_place_form">Lugar de Expedición</label>
                                        <input id="expedition_place_form" class="form-control m-input" autocomplete="off" name="expedition_place" type="text" value="{{ old('expedition_place', $employee->expedition_place) }}">
                                    </div>
                                    <div class="form-group m-form__group col-12">
                                        <label for="name_form">Nombre</label>
                                        <input id="name_form" class="form-control m-input" autocomplete="off" name="name" type="text" value="{{ old('name', $employee->name) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="m-wizard__form-step " id="m_wizard_form_step_2">
                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group col-12">
                                        <label for="last_name_form">Apellidos</label>
                                        <input id="last_name_form" class="form-control m-input" autocomplete="off" name="last_name" type="text" value="{{ old('last_name', $employee->last_name) }}">
                                    </div>
                                    <div class="form-group m-form__group col-12">
                                        <label for="sex_form">Sexo</label>
                                        <select id="sex_form" class="form-control m-bootstrap-select m_selectpicker" name="sex" tabindex="-98">
                                            <option selected="selected" value="">Seleccione una opción</option>
                                            <option value="FEMENINO" {{ old('sex') == $employee->sex || in_array($employee->sex, __('app.selects.person.sex')) ? 'selected' : "" }}>FEMENINO</option>
                                            <option value="MASCULINO" {{ old('sex') == $employee->sex || in_array($employee->sex, __('app.selects.person.sex')) ? 'selected' : "" }}>MASCULINO</option>
                                        </select>
                                    </div>
                                    <div class="form-group m-form__group col-12">
                                        <label for="birth_date_form">Fecha de Nacimiento</label>
                                        <input id="birth_date_form" class="form-control datepicker" data-provide="datepicker" style="width: 100%" autocomplete="off" name="birth_date" type="text" value="{{ old('birth_date', $employee->birth_date) }}">
                                    </div>
                                    <div class="form-group m-form__group col-12">
                                        <h5>Información de Contacto</h5>
                                    </div>
                                    <div class="form-group m-form__group col-12">
                                        <label for="address_form">Dirección</label>
                                        <input id="address_form" class="form-control m-input" autocomplete="off" name="address" type="text" value="{{ old('address', $employee->address) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="m-wizard__form-step " id="m_wizard_form_step_3">
                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group col-12">
                                        <label for="neighborhood_form">Barrio</label>
                                        <input id="neighborhood_form" class="form-control m-input" autocomplete="off" name="neighborhood" type="text" value="{{ old('cellphone', $employee->neighborhood) }}">
                                    </div>
                                    <div class="form-group m-form__group col-12">
                                        <label for="phone_form">Telefono</label>
                                        <input id="phone_form" class="form-control m-input" autocomplete="off" name="phone" type="text" value="{{ old('phone', $employee->phone) }}">
                                    </div>
                                    <div class="form-group m-form__group col-12">
                                        <label for="cellphone_form">Celular</label>
                                        <input id="cellphone_form" class="form-control m-input" autocomplete="off" name="cellphone" type="text" value="{{ old('cellphone', $employee->cellphone) }}">
                                    </div>
                                    <div class="form-group m-form__group col-12">
                                        <label for="email_form">Correo Electrónico</label>
                                        <input id="email_form" class="form-control m-input" autocomplete="off" name="email" type="text" value="{{ old('email', $employee->email) }}">
                                    </div>
                                    <div class="form-group m-form__group col-12">
                                        <label for="position_id_form">Cargo</label>
                                        <select id="position_id_form" class="form-control m-bootstrap-select m_selectpicker" name="position_id" tabindex="-98">
                                            <option value="">Seleccione un opción</option>
                                            @foreach($positions as $key => $position)
                                                <option value="{{ $key }}" {{ old('position_id') == $key || $employee->position_id == $key ? 'selected' : ""}}>{{ $position }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions m-form__actions" style="padding: 15px;">
                                <div class="row align-items-center">
                                    <div class="col-lg-8 m--align-left">
                                        <button id="formButton" class="btn btn-primary" data-action="create" type="button">Actualizar</button>
                                    </div>
                                    <div class="col-lg-4 m--align-right">
                                        <button class="btn btn-secondary" data-wizard-action="prev" type="button"><i class="fa fa-chevron-left"></i><span></span></button>
                                        <button class="btn btn-secondary" data-wizard-action="next" type="button"><span></span><i class="fa fa-chevron-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @include('includes.scripts')
@endpush
