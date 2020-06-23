<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style type="text/css" rel="stylesheet">
        .info {
            opacity: 1;
            transition: all 2s ease-in;
        }
    </style>
</head>

<body>
    <div id="app">

        <menu-principal></menu-principal>

        <main>
            @yield('content')
        </main>
    </div>

    <script src="https://kit.fontawesome.com/15d9aa85c2.js" crossorigin="anonymous"></script>
</body>

</html>
