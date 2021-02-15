@component('mail::message')
# Hola {{ $body['loan']->beneficiary->full_name }}

Queremos informarte que la solicitud de préstamos que realizaste el día **{{ $body['loan']->created_at->format('d/m/Y') }}** con nombre **{{ $body['loan']->name }}** se encuentra en estado **{{ $body['loan']->state }}**

@component('mail::button', ['url' => $url])
Ir a mis préstamos
@endcomponent

Saludos !!,<br>
{{ config('app.name') }}
@endcomponent
