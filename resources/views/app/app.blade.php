<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (Auth::check())
        <meta name="authenticated" content="1">
    @endif

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
    </div>
    <!-- Scripts -->
    <script src="{{ mix('js/socket.io.js') }}"></script>
    <script>
        var APP_NAME = "{{ env('APP_NAME') }}";
        // var APP_SHORT_NAME = "{{ env('APP_SHORT_NAME') }}";
        var SOCKET_URL = "{{ env('SOCKET_URL', 'http://' . Request::getHost() . ':6001') }}";
        {{-- var API_URL = "{{ env('API_URL', 'http://' . Request::getHost()) }}"; --}}
    </script>

    {{-- Stripe payment --}}
    {{-- <script src="https://js.stripe.com/v3/"></script> --}}

    {{-- Gamelancer app --}}
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
