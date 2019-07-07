<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') . ' - ' }}@yield('title')</title>
    <script src="{{ asset('js/vendors.bundle.js') }}" type="text/javascript" defer></script>
    <script src="{{ asset('js/scripts.bundle.js') }}" type="text/javascript" defer></script>
    <script src="{{ asset('js/datatables.bundle.js') }}" type="text/javascript" defer></script>
    <!--script src="{{ asset('js/app.js') }}" type="text/javascript" defer></script-->
    @stack('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <link href="{{ asset('css/vendors.bundle.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/datatables.bundle.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
</head>
@yield('body')
</html>
