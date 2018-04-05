<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->

    <!-- CSRF Stuff -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>
    <title>{{ config('app.name', 'Survey Builder') }}</title>

    <!-- Styles-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @include('inc.navbar')
    @include('inc.messages')
    @yield('content')

    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
