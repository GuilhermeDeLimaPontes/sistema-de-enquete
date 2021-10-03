<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ url('assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        @auth
            <div class="container">
                <a href="{{ route('users.index') }}" class="navbar-brand">Sistema de <b>Enquete</b></a>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item btn btn-warning btn-sm"><a href="{{ route('poll.create') }}"
                            class="nav-link text-dark">Criar Enquete</a></li>
                    <li class="nav-item btn btn-warning btn-sm ms-2"><a href="{{ route('users.logout') }}"
                            class="nav-link text-dark ">Sair</a></li>
                </ul>
            </div>
        @endauth

        @guest
            <div class="container">
                <a href="" class="navbar-brand"><b>Enquete</b></a>
            </div>
        @endguest
    </nav>

    <div class="container">
        @yield('content')
    </div>
    <script src="{{ url('assets/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/dist/js/functions.js') }}"></script>
</body>

</html>
