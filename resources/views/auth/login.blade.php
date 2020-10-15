<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sys_prt</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="icon" href="/img/favicon.png" type="image/png" />

    <style>
        .fundo {
            background: linear-gradient(50deg, #0d4a8e, #0e2e1a) no-repeat;
            height: 100vh;
            overflow: unset;
        }

        input:hover {
            background: linear-gradient(50deg, #0d4a8e, #0e2e1a) no-repeat;
            border-left: 5px;
            border-right: 5px;
            border-style: solid;
            border-color: white;
        }
        .corprt {
            color: #0d4a8e;
        }
    </style>
</head>

<body class="fundo">

    <div class="container-fluid">
        <div class="fixed-top text-center display-1 " style="display: none; color: white;" id="carregando"> <h1 >Entrando...</h1> <i class="fas fa-cog fa-pulse icon"></i></div>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6 offset-3" id="formulario" style="margin: 0 auto;">
                <form method="POST" action="{{ route('login') }}" style="margin-top: 25vh;" id="entrada">
                    @csrf
                    <div class="text-center p-1">
                        <img src="{{url('img/logo.png')}}" class="bg-light rounded" style="max-width: 100px;" />
                    </div>
                    <div class="form-group ">
                        <label class="mb-0 text-center text-light">E-mail</label>
                        <input type="email" class="form-control-plaintext text-center text-light border-bottom border-light" name="email" id="email" placeholder="email@exemplo.com" required>
                    </div>
                    <div class="form-group">
                        <label class="mb-0 text-center text-light">Senha</label>
                        <input type="password" class="form-control-plaintext text-center text-light border-bottom border-light" name="password" id="senha" placeholder="Senha" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" id="entrar" class="btn btn-primary container" style="border-radius: 20px;" id="entrar">Entrar</button>
                        <a class="btn container text-center text-light mb-5 fixed-bottom" style="border-radius: 20px;" href="/politicadeprivacidade">
                           Politica de privacidade </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/15d9aa85c2.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>

<script type="text/javascript">

                      if (window.localStorage.getItem('login') == 'ok') {
                          $('#email').val(window.localStorage.getItem('email'))
                          $('#senha').val(window.localStorage.getItem('senha'))

                          $('#formulario').css('display', 'none')
                          $('#carregando').css('display', 'block')
                          $('#entrar').trigger('click')
                      } else {
                          if (window.localStorage.getItem('email') != null) {
                              $('#formulario').append('<h4 class="text-danger text-center">Usuário ou senha incorretos!</h4>')
                          }

                      }







    $(() => {
        $('#entrada').on('submit', () => {
            window.localStorage.setItem('email', $('#email').val())
            window.localStorage.setItem('senha', $('#senha').val())
        })
    })

</script>

</html>
