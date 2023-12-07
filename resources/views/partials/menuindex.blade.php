<nav class="navbar navbar-expand-lg navbar-dark  navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('sesion.index') }}">NERD</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">

                    @if (Route::has('login'))
                        <a class="nav-link " aria-current="page" href="{{ route('sesion.index') }}">Inicio</a>
                    @else
                        <a class="nav-link " aria-current="page" href="inicio">Inicio</a>
                    @endif
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Nosotros
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Misión</a></li>
                        <li><a class="dropdown-item" href="#">Visión</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Proyección 2024</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href=" {{ route('productos.index') }} ">Productos</a>
                </li>
                @auth
                    <li class="nav-item">
                        <button class="btn btn-link nav-link" data-bs-toggle="modal" data-bs-target="#modalPQR">PQR</button>
                    </li>
                @endauth

                <li class="nav-item">
            </ul>

            <form class="d-flex" role="search" method="GET" action="{{ route('productos.index') }}">
                <input name="buscar" class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar"
                    value="{{ $busqueda ?? '' }}">
                <button style="color: white; border: 1px solid white; margin-right: 15px;"
                    class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
        </div>
        <div class="ContainerLoginAuth d-flex">
            @if (Route::has('login'))
                <div class="LoginAuth sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/session') }}"
                            class="btn btn-outline-success font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" ">
                                                            Área de Trabajo
                                                        </a>
@else
    <a href="{{ route('login.index') }}"
                                                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 btn btn-outline-success " style="margin-right: 5px;">Log
                                                            in
                                                        </a>
                                                                @if (Route::has('register'))
                            <a href="{{ route('departamentos.index') }}"
                                class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 btn btn-outline-success">Register</a>
                @endif
            @endauth
        </div>
        @endif

        <!-- Authentication Links -->

    </div>

    </div>
</nav>
<!-- Modal -->
<div class="modal fade" id="modalPQR" tabindex="-1" role="dialog" aria-labelledby="modalPQRLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background: hsl(230, 30%, 15%)">
                <h5 class="modal-title texto" id="staticBackdropLabel">PQR</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="{{ route('pqr') }}" method="post">
                @csrf
                <div class="modal-body" style="background: hsl(230, 30%, 40%)">
                    <p class="texto">Por favor, proporcione la siguiente información para procesar su PQR:</p>
                    <h6 class="modal-title texto" id="exampleModalLabel">Tipo de PQR</h6>

                    <!-- Radio buttons para elegir entre Peticiones, Quejas y Reclamos -->
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tipoPQR" id="peticion" value="peticion">
                        <label class="form-check-label texto" for="peticion">
                            Peticiones
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tipoPQR" id="queja"
                            value="queja">
                        <label class="form-check-label texto" for="queja">
                            Quejas
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tipoPQR" id="reclamo"
                            value="reclamo">
                        <label class="form-check-label texto" for="reclamo">
                            Reclamos
                        </label>
                    </div>

                    <!-- Textarea para la Descripción -->
                    <div class="form-group mt-3">
                        <label for="descripcion" class="texto">Descripción:</label>
                        <textarea class="form-control" id="descripcionPQR" name="descripcionPQR" rows="4"></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="background: hsl(230, 30%, 15%)">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>
