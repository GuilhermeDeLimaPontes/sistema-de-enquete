<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Login-Sistema de enquetes</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ url('assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

    </style>

    <!-- Custom styles for this template -->
    <link href="{{ url('assets/dist/css/signin.css') }}" rel="stylesheet">
</head>

<body class="text-center">
    <main class="form-signin">
        @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error )
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif
        <form action="{{ route('users.store') }}" method="POST">
          @csrf
           <a href="{{ route('login') }}"><img class="mb-4" src="{{ url('assets/brand/bootstrap-logo.svg') }}" alt="" width="72" height="57"></a> 
            <h1 class="h3 mb-3 fw-normal">Cadastro de Usuario</h1>
            <div class="form-floating">
                <input type="text" class="form-control" name="name" placeholder="Digite um nome" value="{{ old('name') }}">
                <label for="name">Nome</label>
            </div>
            <div class="form-floating">
                <input type="email" class="form-control" name="email" placeholder="Digite um email" value="{{ old('email') }}" >
                <label for="email">Email</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" name="password" placeholder="Senha">
                <label for="password">Senha</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Cadastrar</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2017???2021</p>
        </form>
    </main>
</body>

</html>
