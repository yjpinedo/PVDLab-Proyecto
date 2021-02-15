@component('mail::message')
# Hola {{ $body['project']->beneficiary->full_name }}

Queremos informarte de que el proyecto **{{ $body['project']->name }}** se encuentra en estado **{{ $body['project']->concept }}**

@component('mail::button', ['url' => $url])
Ir a mis proyectos
@endcomponent

Saludos !!,<br>
{{ config('app.name') }}
@endcomponent
