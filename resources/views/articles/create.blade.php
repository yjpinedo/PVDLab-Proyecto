@extends('layouts.app')

@section('title', __('app.titles.articles'))

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="m-portlet" id="form-portlet" style="">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 id="formTitle" class="m-portlet__head-text m--font-brand">Información del Artículo</h3>
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
                            </div>
                        </div>
                    </div>
                    <div id="validations" class="m-portlet__padding-x m--hide">
                        <div class="m-alert m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>¡Alerta!</strong> Hay errores de validación en el formulario.
                        </div>
                    </div>
                    <div class="m-wizard__form">
                        <form method="POST" action="{{ route('articles.store') }}" accept-charset="UTF-8" class="m-form" id="form">
                            <div class="m-portlet__body m--padding-10">
                                <div class="m-wizard__form-step m-wizard__form-step--current" id="m_wizard_form_step_1">
                                    <div class="m-form__section m-form__section--first">
                                        <div class="form-group m-form__group col-12">
                                            <label for="category_id_form">Categorías</label>
                                            <div class="input-group">
                                                <div class="dropdown bootstrap-select input-group-btn form-control m-bootstrap-select m_">
                                                    <select id="category_id_form" class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="category_id" tabindex="-98">

                                                    </select>
                                                </div>
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary select-reload" type="button" ><i class="fa fa-circle-notch"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group col-12">
                                            <label for="code_form">Codigo</label>
                                            <input id="code_form" class="form-control m-input" autocomplete="off" name="code" type="text">
                                        </div>
                                        <div class="form-group m-form__group col-12">
                                            <label for="name_form">Nombre</label>
                                            <input id="name_form" class="form-control m-input" autocomplete="off" name="name" type="text">
                                        </div>
                                        <div class="form-group m-form__group col-12">
                                            <label for="brand_form">Marca</label>
                                            <input id="brand_form" class="form-control m-input" autocomplete="off" name="brand" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="m-wizard__form-step " id="m_wizard_form_step_2">
                                    <div class="m-form__section m-form__section--first">
                                        <div class="form-group m-form__group col-12">
                                            <label for="serial_form">Serial</label>
                                            <input id="serial_form" class="form-control m-input" autocomplete="off" name="serial" type="text" >
                                        </div>
                                        <div class="form-group m-form__group col-12">
                                            <label for="pattern_form">Modelo</label>
                                            <input id="pattern_form" class="form-control m-input" autocomplete="off" name="pattern" type="text" >
                                        </div>
                                        <div class="form-group m-form__group col-12">
                                            <label for="description_form">Descripción</label>
                                            <textarea id="description_form" class="form-control m-input" rows="5" autocomplete="off" name="description" cols="50" ></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions" style="padding: 15px;">
                                    <div class="row align-items-center">
                                        <div class="col-lg-8 m--align-left">
                                            <button id="formButton" class="btn btn-primary" data-action="creating" type="button">Guardar</button>
                                        </div>
                                        <div class="col-lg-4 m--align-right">
                                            <button class="btn btn-secondary" data-wizard-action="prev" type="button" ><i class="fa fa-chevron-left"></i><span></span></button>
                                            <button class="btn btn-secondary" data-wizard-action="next" type="button" ><span></span><i class="fa fa-chevron-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @include('includes.scripts')
@endpush
