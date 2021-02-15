@component('mail::message')
# Hola {{ $emailFormat['beneficiary']->full_name }}

Queremos informarte que aplicaste al  curso  **{{ $emailFormat['course']->name }}** de forma exitosa

@component('mail::button', ['url' => $url])
Ir a mis cursos
@endcomponent

Saludos !!,<br>
{{ config('app.name') }}
@endcomponent
