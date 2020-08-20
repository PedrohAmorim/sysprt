<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <?php  if(!isset($_SESSION['versao'])) { session_start();}  ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>PRT</title>
    <link rel="icon" href="/img/favicon.png" type="image/png" />

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}?v=<?=isset($_SESSION['versao']) ? $_SESSION['versao'] : '0' ?>" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}?v=<?=$_SESSION['versao']?>" rel="stylesheet">

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
        <div id="navegador" class="row">
        </div>
        <menu-principal></menu-principal>

        <main>
            @yield('content')
        </main>
    </div>

    <script src="https://kit.fontawesome.com/15d9aa85c2.js" crossorigin="anonymous"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript">
        function navegador_app() {
            return navigator.userAgent.toLowerCase().includes('build/')
        }


        //Função para colocar o navegador em tela inteira
        function requestFullScreen() {
            if ((document.fullScreenElement && document.fullScreenElement !== null) ||
                (!document.mozFullScreen && !document.webkitIsFullScreen)) {
                if (document.documentElement.requestFullScreen) {
                    document.documentElement.requestFullScreen();
                } else if (document.documentElement.mozRequestFullScreen) {
                    document.documentElement.mozRequestFullScreen();
                } else if (document.documentElement.webkitRequestFullScreen) {
                    document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
                }
            } else {
                if (document.cancelFullScreen) {
                    document.cancelFullScreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.webkitCancelFullScreen) {
                    document.webkitCancelFullScreen();
                }
            }
        }
    </script>
</body>


</html>
