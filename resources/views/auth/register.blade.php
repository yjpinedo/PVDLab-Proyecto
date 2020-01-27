@extends('layouts.auth')

@php($crud = 'register')

@section('content')
    <form class="m-login__form m-form" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group m-form__group">
            <label for="document_type" class="m--hide">{{ __('validation.attributes.name') }}</label>
            <select id="document_type" class="form-control @error('document_type') is-invalid @enderror" name="document_type" required autofocus>
                <option>{{ __('validation.attributes.document_type') }}</option>
                <option value="{{ __('app.selects.person.document_type.CÉDULA DE CIUDADANÍA') }}" {{ old('document_type') == __('app.selects.person.document_type.CÉDULA DE CIUDADANÍA') ? 'selected' : '' }}>{{ __('app.selects.person.document_type.CÉDULA DE CIUDADANÍA') }}</option>
                <option value="{{ __('app.selects.person.document_type.CÉDULA DE EXTRANJERÍA') }}" {{ old('document_type') == __('app.selects.person.document_type.CÉDULA DE EXTRANJERÍA') ? 'selected' : '' }}>{{ __('app.selects.person.document_type.CÉDULA DE EXTRANJERÍA') }}</option>
            </select>

            @error('document_type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group m-form__group">
            <label for="document" class="m--hide">{{ __('validation.attributes.document') }}</label>
            <input id="document" type="text" class="form-control @error('document') is-invalid @enderror" name="document" value="{{ old('document') }}" placeholder="{{ __('validation.attributes.document') }}" required autocomplete="on">

            @error('document')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group m-form__group">
            <label for="expedition_place" class="m--hide">{{ __('validation.attributes.expedition_place') }}</label>
            <input id="expedition_place" type="text" class="form-control @error('expedition_place') is-invalid @enderror" name="expedition_place" value="{{ old('expedition_place') }}" placeholder="{{ __('validation.attributes.expedition_place') }}" required autocomplete="country-name">

            @error('expedition_place')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group m-form__group">
            <label for="name" class="m--hide">{{ __('validation.attributes.name') }}</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="{{ __('validation.attributes.name') }}" required autocomplete="name">

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group m-form__group">
            <label for="last_name" class="m--hide">{{ __('validation.attributes.last_name') }}</label>
            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" placeholder="{{ __('validation.attributes.last_name') }}" required autocomplete="family-name">

            @error('last_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group m-form__group">
            <label for="sex" class="m--hide">{{ __('validation.attributes.sex') }}</label>
            <select id="sex" class="form-control @error('sex') is-invalid @enderror" name="sex" required>
                <option>{{ __('validation.attributes.sex') }}</option>
                <option value="{{ __('app.selects.person.sex.FEMENINO') }}" {{ old('sex') == __('app.selects.person.sex.FEMENINO') ? 'selected' : '' }}>{{ __('app.selects.person.sex.FEMENINO') }}</option>
                <option value="{{ __('app.selects.person.sex.MASCULINO') }}" {{ old('sex') == __('app.selects.person.sex.MASCULINO') ? 'selected' : '' }}>{{ __('app.selects.person.sex.MASCULINO') }}</option>
            </select>

            @error('sex')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group m-form__group">
            <label for="birth_date" class="m--hide">{{ __('validation.attributes.birth_date') }}</label>
            <input id="birth_date" type="text" class="form-control datepicker @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date') }}" placeholder="{{ __('validation.attributes.birth_date') }}" data-provide="datepicker" readonly required>

            @error('birth_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group m-form__group">
            <label for="place_of_birth" class="m--hide">{{ __('validation.attributes.place_of_birth') }}</label>
            <input id="place_of_birth" type="text" class="form-control @error('place_of_birth') is-invalid @enderror" name="place_of_birth" value="{{ old('place_of_birth') }}" placeholder="{{ __('validation.attributes.place_of_birth') }}" required autocomplete="country-name">

            @error('place_of_birth')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group m-form__group">
            <label for="address" class="m--hide">{{ __('validation.attributes.address') }}</label>
            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" placeholder="{{ __('validation.attributes.address') }}" required autocomplete="on">

            @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group m-form__group">
            <label for="neighborhood" class="m--hide">{{ __('validation.attributes.neighborhood') }}</label>
            <input id="neighborhood" type="text" class="form-control @error('neighborhood') is-invalid @enderror" name="neighborhood" value="{{ old('neighborhood') }}" placeholder="{{ __('validation.attributes.neighborhood') }}" required autocomplete="on">

            @error('neighborhood')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group m-form__group">
            <label for="phone" class="m--hide">{{ __('validation.attributes.phone') }}</label>
            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="{{ __('validation.attributes.phone') }}" required autocomplete="tel">

            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group m-form__group">
            <label for="cellphone" class="m--hide">{{ __('validation.attributes.cellphone') }}</label>
            <input id="cellphone" type="text" class="form-control @error('cellphone') is-invalid @enderror" name="cellphone" value="{{ old('cellphone') }}" placeholder="{{ __('validation.attributes.cellphone') }}" required autocomplete="tel">

            @error('cellphone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group m-form__group">
            <label for="email" class="m--hide">{{ __('validation.attributes.email') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('validation.attributes.email') }}" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group m-form__group">
            <label for="occupation" class="m--hide">{{ __('validation.attributes.occupation') }}</label>
            <input id="occupation" type="text" class="form-control @error('occupation') is-invalid @enderror" name="occupation" value="{{ old('occupation') }}" placeholder="{{ __('validation.attributes.occupation') }}" required autocomplete="on">

            @error('occupation')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group m-form__group">
            <label for="ethnic_group" class="m--hide">{{ __('validation.attributes.ethnic_group') }}</label>
            <select id="ethnic_group" class="form-control @error('ethnic_group') is-invalid @enderror" name="ethnic_group" required>
                <option>{{ __('validation.attributes.ethnic_group') }}</option>
                <option value="{{ __('app.selects.person.ethnic_group.COMUNIDAD RAIZAL') }}" {{ old('ethnic_group') == __('app.selects.person.ethnic_group.COMUNIDAD RAIZAL') ? 'selected' : '' }}>{{ __('app.selects.person.ethnic_group.COMUNIDAD RAIZAL') }}</option>
                <option value="{{ __('app.selects.person.ethnic_group.COMUNIDADES NEGRAS O AFROCOLOMBIANAS') }}" {{ old('ethnic_group') == __('app.selects.person.ethnic_group.COMUNIDADES NEGRAS O AFROCOLOMBIANAS') ? 'selected' : '' }}>{{ __('app.selects.person.ethnic_group.COMUNIDADES NEGRAS O AFROCOLOMBIANAS') }}</option>
                <option value="{{ __('app.selects.person.ethnic_group.PUEBLOS Y COMUNIDADES INDÍGENAS') }}" {{ old('ethnic_group') == __('app.selects.person.ethnic_group.PUEBLOS Y COMUNIDADES INDÍGENAS') ? 'selected' : '' }}>{{ __('app.selects.person.ethnic_group.PUEBLOS Y COMUNIDADES INDÍGENAS') }}</option>
                <option value="{{ __('app.selects.person.ethnic_group.NO PERTENECE A NINGUNO DE LOS ANTERIORES') }}" {{ old('ethnic_group') == __('app.selects.person.ethnic_group.NO PERTENECE A NINGUNO DE LOS ANTERIORES') ? 'selected' : '' }}>{{ __('app.selects.person.ethnic_group.NO PERTENECE A NINGUNO DE LOS ANTERIORES') }}</option>
                <option value="{{ __('app.selects.person.ethnic_group.OTROS') }}" {{ old('ethnic_group') == __('app.selects.person.ethnic_group.OTROS') ? 'selected' : '' }}>{{ __('app.selects.person.ethnic_group.OTROS') }}</option>
            </select>

            @error('ethnic_group')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group m-form__group">
            <label for="other_ethnic_group" class="m--hide">{{ __('validation.attributes.other_ethnic_group') }}</label>
            <input id="other_ethnic_group" type="text" class="form-control @error('other_ethnic_group') is-invalid @enderror" name="other_ethnic_group" value="{{ old('other_ethnic_group') }}" placeholder="{{ __('validation.attributes.other_ethnic_group') }}" autocomplete="on">

            @error('other_ethnic_group')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group m-form__group">
            <label for="stratum" class="m--hide">{{ __('validation.attributes.stratum') }}</label>
            <input id="stratum" type="text" class="form-control @error('stratum') is-invalid @enderror" name="stratum" value="{{ old('stratum') }}" placeholder="{{ __('validation.attributes.stratum') }}" required>

            @error('stratum')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group m-form__group">
            <label for="password" class="m--hide">{{ __('validation.attributes.password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('validation.attributes.password') }}" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group m-form__group">
            <label for="password-confirm" class="m--hide">{{ __('validation.attributes.password_confirmation') }}</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('validation.attributes.password_confirmation') }}" required autocomplete="new-password">
        </div>

        <div class="m-login__form-action">
            <button class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--air" type="submit">{{ __('base.buttons.submit') }}</button>&nbsp;&nbsp;
            <a href="{{ route('home') }}" class="btn btn-outline-primary m-btn m-btn--pill m-btn--custom">{{ __('base.buttons.cancel') }}</a>
        </div>
    </form>
@endsection

@push('scripts')
    <script type="text/javascript" defer>
        $(document).ready( function () {
            $('.datepicker').datepicker({
                autoclose: true,
                format : "yyyy-mm-dd",
            });
        });
    </script>
@endpush
