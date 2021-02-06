@extends('layouts.app')

@section('title', __('app.titles.loans'))

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="m-portlet" id="form-portlet" style="">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 id="formTitle" class="m-portlet__head-text m--font-brand">Información de Préstamo</h3>
                        </div>
                    </div>
                </div>
                <div id="validations" class="m-portlet__padding-x m--hide">
                    <div class="m-alert m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>¡Alerta!</strong> Hay errores de validación en el formulario.
                    </div>
                </div>
                <form method="POST" accept-charset="UTF-8" class="m-form" id="form">
                    @csrf
                    <div class="m-portlet__body m--padding-10">
                        <div class="m-form__section m-form__section--first">
                            <div class="form-group m-form__group col-12 mt-2">
                                <label for="refund_form">Fecha de Entrega</label>
                                <input id="refund_form" class="form-control datepicker" data-provide="datepicker" style="width: 100%" autocomplete="off" name="refund" type="text">
                            </div>
                            <div class="form-group m-form__group col-12">
                                <label for="beneficiary_id_form">Beneficiario</label>
                                <div class="input-group">
                                    <div class="dropdown bootstrap-select input-group-btn form-control m-bootstrap-select m_">
                                        <select id="beneficiary_id_form" class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="beneficiary_id" tabindex="-98">
                                        </select>
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary select-reload" type="button" ><i class="fa fa-circle-notch"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-form__group col-12">
                                <label for="article_id_form">Artículo</label>
                                <div class="input-group">
                                    <div class="dropdown bootstrap-select input-group-btn form-control m-bootstrap-select m_">
                                        <select id="article_id_form" class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="article_id" tabindex="-98">
                                        </select>
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary select-reload" type="button" ><i class="fa fa-circle-notch"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-form__group col-12">
                                <label for="quantity_form">Cantidad</label>
                                <input id="quantity_form" class="form-control m-input" autocomplete="off" name="quantity" type="text">
                            </div>
                            <div class="form-group m-form__group col-12">
                                <button id="btnAddArticle" class="btn btn-primary btn-block" type="button">Agregar Artículo</button>
                            </div>
                            <div class="form-group m-form__group col-12">
                                <table id="articles_loans" class="table table-striped- table-bordered table-hover table-checkable table-component dtr-inline">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Serial</th>
                                        <th>Cantidad</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions" style="padding: 15px;">
                            <div class="row align-items-center">
                                <div class="col-lg-8 m--align-left">
                                    <button id="formButton" class="btn btn-primary btn-block add-loan" data-action="creating" type="button">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @include('includes.scripts')
    <script>
        $(function (){
            $('.add-loan').hide();
        });
    </script>
@endpush
