<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Área de Trabajo</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href=" {{ asset('css/index.css') }} ">
    <link rel="stylesheet" href=" {{ asset('css/RegistroActividad.css') }} ">

</head>

<body>
    @include('partials.header')
    @include('partials.menuindex')
    <div class="container-fluid w-100">
        <div class="row d-flex align-items-center">
            <div class="col-9">

            </div>
            <div class="col-3">
                @auth

                    <h2>Bienvenido, {{ Auth::user()->name }}</h2>
                @endauth
                <h3></h3>
            </div>

        </div>
        <div class="d-flex">


            <!-- Sidebar -->

            <nav id="sidebar" class="bg-light">
                @if (!request()->is('session/productos'))
                    <!-- Verifica si la ruta actual no coincide con 'session/productos' -->
                    <div class="p-4">
                        <ul class="list-unstyled">
                            @auth
                                @if (Auth::user()->tipo == 'Administrador')
                                    @auth
                                        <h2> {{ Auth::user()->tipo }} </h2>
                                        <li><a href="">Crear Nuevo Administrador</a></li>
                                        <li><a href="{{ route('administrador.create') }}">Crear Nuevo Colaborador</a></li>
                                        <li><a href="">Dashboard</a></li>
                                        <li><a href=" {{ route('solicitudes.show') }} ">Solicitudes</a></li>
                                    @endauth
                                @else
                                    @auth
                                        <h2> {{ Auth::user()->tipo }} </h2>
                                        <li><a href="{{ route('cliente.edit', Auth::user()->id) }}">Actualizar perfil</a></li>
                                        <li><a href="#">Desactivar cuenta</a></li>
                                        <li><a href="{{ route('sesion.actividad', Auth::user()->id) }}">Registro de
                                                actividad</a></li>
                                        <li><a href=" {{ route('cliente.changePasswordForm') }} ">Cambiar contraseña</a></li>
                                        <li><a href="{{ route('cliente.solicitarAlianzaForm') }}">Solicitar Alianza</a></li>
                                    @endauth
                                @endif
                            @endauth
                            <li>
                                @auth
                                    <a class="" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Cerrar sesión
                                    </a>
                                @endauth
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                @endif
            </nav>

            <!-- Page Content -->
            <div id="content" class="p-4">

                @if (session('error_message') && now() <= session('flash_lifetime'))
                    <div class="alert alert-warning">
                        {{ session('error_message') }}
                    </div>
                @endif
                @if (auth()->check())
                    @yield('contenidoAT')

                @else
                    
                    <p>Por favor, inicia sesión.</p>
                    
                @endif

            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </div>
    </div>
</body>

</html>
