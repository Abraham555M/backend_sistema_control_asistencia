@component('mail::message')
# Hola {{ $empleado->nom_empleado }} 👋

Has sido registrado en el sistema de la empresa. Para crear tu cuenta de acceso, haz clic en el siguiente botón:

@component('mail::button', ['url' => $link])
Crear mi cuenta
@endcomponent

Este enlace expirará en 48 horas.

Gracias,<br>
{{ config('app.name') }}
@endcomponent
