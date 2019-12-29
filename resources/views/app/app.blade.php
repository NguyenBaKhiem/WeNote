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
    <script src="https://api.tiles.mapbox.com/mapbox-gl-js/v1.6.1/mapbox-gl.js"></script>
    <link href="https://api.tiles.mapbox.com/mapbox-gl-js/v1.6.1/mapbox-gl.css" rel="stylesheet" />
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
    </div>
    <!-- Scripts -->
    <script src="{{ mix('js/socket.io.js') }}"></script>
    <script>
        var APP_NAME = "{{ env('APP_NAME') }}";
    </script>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
