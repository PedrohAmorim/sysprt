<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sys_PRT</title>
    <link rel="icon" href="/img/favicon.png" type="image/png" />

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

        .fundo {
            background: linear-gradient(50deg, #0d4a8e, #0e2e1a) no-repeat;
            overflow: unset;
        }

        .corprt {
            color: #0d4a8e;
        }

        i:hover {
            color: yellow;
            transition: all 0.5s ease;
        }

        .margin {
            margin: 2px !important;
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
    <script src="js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript">

//             $('#navegador').html(navigator.userAgent.toLowerCase())


        //Função para colocar o navegador em tela inteira
        function requestFullScreen() {

            var el = document.body;

            // Supports most browsers and their versions.
            var requestMethod = el.requestFullScreen || el.webkitRequestFullScreen ||
                el.mozRequestFullScreen || el.msRequestFullScreen;

            if (requestMethod) {

                // Native full screen.
                requestMethod.call(el);

            } else if (typeof window.ActiveXObject !== "undefined") {

                // Older IE.
                var wscript = new ActiveXObject("WScript.Shell");

                if (wscript !== null) {
                    wscript.SendKeys("{F11}");
                }
            }
        }
    </script>
</body>


</html>
