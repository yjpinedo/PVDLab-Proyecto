@extends('layouts.app')

@section('title', __('app.titles.profile'))

@section('content')
    <div class="col-xl-12">
        <div class="m-portlet" id="form-portlet" style="">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text m--font-brand">Actualizar contraseña</h3>
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
                        <div class="form-group m-form__group col-12">
                            <label for="password-current_form">Contraseña Actual</label>
                            <input id="password-current_form" class="form-control m-input" autocomplete="off" name="password-current" type="password">
                        </div>
                        <div class="form-group m-form__group col-12">
                            <label for="password_form">Nueva Contraseña</label>
                            <input id="password_form" class="form-control m-input" autocomplete="off" name="password" type="password">
                        </div>
                        <div class="form-group m-form__group col-12">
                            <label for="password_confirmation">Confirmación Nueva Contraseña</label>
                            <input id="password_confirmation" class="form-control m-input" autocomplete="off" name="password_confirmation" type="password">
                        </div>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions" style="padding: 15px;">
                        <div class="row align-items-center">
                            <div class="col-lg-8 m--align-left">
                                <button id="formButton" class="btn btn-primary" data-action="create" type="button">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    @include('includes.scripts')
    <script>
        //$('#form')[0].reset();
        $(function (){
        });
    </script>
@endpush
