<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>sys_prt</title>

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
            background: linear-gradient(50deg, #0d4a8e , #0e2e1a ) no-repeat;
            border-left: 5px;
            border-right: 5px;
            border-style: solid;
            border-color: white;
        }
    </style>
</head>

<body class="fundo">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6 offset-3" style="margin: 0 auto;">
                <form method="POST" action="{{ route('login') }}" style="margin-top: 100px;">
                    @csrf
                    <div class="text-center p-1">
                        <img src="{{url('img/logo.png')}}" class="bg-light rounded" style="max-width: 150px;" />
                    </div>
                    <div class="form-group ">
                        <label class="mb-0 display-4 text-center text-light">E-mail</label>
                        <input type="email" class="form-control-plaintext text-center text-light border-bottom border-light" name="email" placeholder="email@exemplo.com" required>
                    </div>
                    <div class="form-group">
                        <label class="mb-0 display-4 text-center text-light">Senha</label>
                        <input type="password" class="form-control-plaintext text-center text-light border-bottom border-light" name="password" placeholder="Senha" required>
                    </div>

                    <button type="submit" class="btn btn-primary container" style="border-radius: 20px;" id="entrar">Entrar</button>
                    <a  class="btn btn-link text-center container" href="{{ route('register') }}">Registrar-se</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


</body>

</html>
