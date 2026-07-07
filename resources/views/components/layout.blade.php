<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} :: Lo de Akara</title>
    <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('css/main.css')}}">
    <script src="https://kit.fontawesome.com/c73e92378d.js" crossorigin="anonymous"></script>
</head>
<body class="bg-texture">
<div class="bg-texture-color">
    <nav class="navbar navbar-expand-lg bg-navbar" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('home')}}">Lo de Akara</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('games.index')}}">Juegos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('blogs.index')}}">Blog</a>
                    </li>
                    @auth
                        @if(auth()->user()->admin)
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('admin.dashboard')}}">Panel de administrador</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('user.index', auth()->user()->id)}}">Cuenta</a>
                        </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('cart.index')}}">Carrito</a>
                            </li>
                        <li class="nav-item">
                            <form action="{{route('auth.logout')}}" method="POST">
                                @csrf
                                <button class="nav-link" type="submit">Cerrar sesión</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('auth.showLogin')}}">Iniciar Sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('auth.showRegister')}}">Registrarse</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="container bg-white p-3 min-vh-100 shadow">
        @if(session()->has('feedback.message'))
            <div class="alert alert-success mt-3">{!! session()->get('feedback.message') !!}</div>
        @endif
        @if(session()->has('alert.message'))
            <div class="alert alert-danger mt-3">{!! session()->get('alert.message') !!}</div>
        @endif
        {{ $slot }}
    </main>
</div>

</body>
</html>
