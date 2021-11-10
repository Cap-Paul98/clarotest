<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
</head>
<body>
    Destinatario: <br>
    {{$addressee}} <br>
    Asunto: <br>
    {{$subject}} <br>
    Fecha de envío: <br>
    {{$shipping_date}} <br>
    Mensaje: <br>
    {{$email_body}} <br>
</body>
</html>

{{-- @component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent --}}