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
</head>
<body>
    <div id="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom border-dark" id='menuPrincipal'>
            <a class="navbar-brand" href="/home"><img class="navbar-brand bg-light" src="{{ url('img/logo.png')}}" style="max-width: 60px;" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn btn-light text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bus"></i> <span class="rotulo">Sistema</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="width: 450px; !important; height: 180px">
                            <div class="row container p-1">
                                <div class="col-sm-5 ">
                                    <h5>Configurações</h5>
                                    <a class="dropdown-item btn btn-light" href="/usuarios"><i class="fas fa-users"></i><span> Usuários</span> </a>
                                    <a class="dropdown-item btn btn-light" href="#"><i class="fas fa-clipboard-list"></i><span> Relatórios</span> </a>
                                    <a class="dropdown-item btn btn-light" href="#"><i class="fas fa-key"></i> Trocar Senha</a>
                                    <a class="dropdown-item btn btn-light" href="#"><i class="fas fa-sign-out-alt"></i> Sair</a>
                                </div>
                                <div class="col-sm-1 border-right"> </div>
                                <div class="col-sm-5">
                                    <h5>Eventos</h5>
                                    <a class="dropdown-item btn btn-light" href="/eventos"><i class="far fa-plus-square"></i><span> Novo</span> </a>
                                    <a class="dropdown-item btn btn-light" href="#"><i class="fas fa-cogs"></i><span> Parâmetros </span> </a>
                                    <a class="dropdown-item btn btn-light" href="#"><i class="fas fa-map-marked-alt"></i> Pontos</a>
                                    <a class="dropdown-item btn btn-light" href="#"><i class="far fa-circle"></i><span> Cercas </span> </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn btn-light text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bus"></i> <span class="rotulo"> Veículos</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="width: 550px; !important; height: 190px">
                            <div class="row container p-1">
                                <div class="col-sm-5 ">
                                    <h5>Localização</h5>
                                    <a class="dropdown-item btn btn-light" href="#"><i class="fas fa-layer-group"></i><span> Todos</span> </a>
                                    <a class="dropdown-item btn btn-light" href="#"><i class="fas fa-satellite"></i><span> Histórico de Localização</span> </a>
                                    <a class="dropdown-item btn btn-light" href="#"><i class="fas fa-bullhorn"></i> Alerta</a>
                                    <a class="dropdown-item btn btn-light" href="#"><i class="fab fa-tencent-weibo"></i> Proximidade do Ponto</a>
                                </div>
                                <div class="col-sm-1 border-right"> </div>
                                <div class="col-sm-5">
                                    <h5>Cadastro</h5>
                                    <a class="dropdown-item btn btn-light" href="#"><i class="far fa-plus-square"></i><span> Novo Veículo</span> </a>
                                    <a class="dropdown-item btn btn-light" href="#"><i class="fas fa-trailer"></i> Modelo</a>
                                    <a class="dropdown-item btn btn-light" href="#"><i class="fas fa-gas-pump"></i> Abastecimento</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link btn btn-light" href="#"><i class="fas fa-route"></i><span class="rotulo"> Itinerários</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link btn btn-light" href="#"><i class="fas fa-clipboard-list"></i><span class="rotulo"> Escalas</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link btn btn-light" href="/motoristas"><i class="fas fa-user-tie"></i></i><span class="rotulo"> Motoristas</span></a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="..." aria-label="Pesquisar">
                    <button class="btn btn-light text-dark my-2 my-sm-0" type="submit"><i class="fas fa-search"></i> Pesquisar</button>
                </form>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="https://kit.fontawesome.com/15d9aa85c2.js" crossorigin="anonymous"></script>
</body>
</html>
