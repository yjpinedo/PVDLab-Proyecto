@component('mail::message')
# Hola {{ $emailFormat['course']->teacher->name }}

Queremos informarte que el beneficiario {{ $emailFormat['beneficiary']->full_name }} se ha inscrito
en el curso {{ $emailFormat['course']->name }} dictado por ti

@component('mail::button', ['url' => $url])
Ver lista de alumnos en el curso
@endcomponent

!! Saludos !! ,<br>
{{ config('app.name') }}
@endcomponent
