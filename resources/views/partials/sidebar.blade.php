<div class="wrapper" id="sidebarWrapper">
    <!-- Sidebar  -->
    @auth
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>{{ Auth::user()->tipo }}</h3>
            </div>

            <ul class="list-unstyled components">
                <p>Acciones:</p>
                @if (Auth::user()->tipo == 'Cliente')
                    <li>
                        <a href="{{ route('cliente.edit', Auth::user()->id) }}" aria-expanded="false" class="nava">Actualizar
                            perfil</a>

                    </li>
                    <li>
                        <a class="nava" href="{{ route('sesion.actividad', Auth::user()->id) }}">Registro de
                            actividad</a>
                    </li>
                    <li>
                        <a class="nava" href="{{ route('cliente.changePasswordForm') }}">Cambiar contraseña</a>
                    </li>
                    <li>
                        <a class="nava" href="{{ route('cliente.solicitarAlianzaForm') }}">Solicitar Alianza</a>
                    </li>
                @elseif(Auth::user()->tipo == 'Administrador')
                    <li>
                        <a class="nava" href="">Crear Nuevo Administrador</a>
                    </li>
                    <li>
                        <a class="nava" href="{{ route('administrador.create') }}">Crear Nuevo Colaborador</a>
                    </li>
                    <li>
                        <a class="nava" href="">Dashboard</a>
                    </li>
                    <li>
                        <a class="nava" href=" {{ route('solicitudes.show') }} ">Solicitudes</a>
                    </li>
                @elseif(Auth::user()->tipo == 'Colaborador')
                    <li>
                        <a href="{{ route('colaborador.edit', Auth::user()->id) }}" aria-expanded="false"
                            class="nava">Actualizar perfil</a>

                    </li>
                    <li>
                        <a class="nava" href="{{ route('sesion.actividad', Auth::user()->id) }}">Registro de
                            actividad</a>
                    </li>
                    <li>
                        <a class="nava" href="{{ route('colaborador.changePasswordForm') }}">Cambiar contraseña</a>
                    </li>
                    <li>
                        <a class="nava" href="{{ route('productos.colaborador', Auth::user()->id) }}">Mis productos</a>
                    </li>
                @endif
            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                    <a class="nava" href="https://bootstrapious.com/tutorial/files/sidebar.zip"
                        class="download">Documentación</a>
                </li>
                <li>
                    @auth
                        <a class="nava" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Cerrar sesión
                        </a>
                    @endauth
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    @endauth

    <!-- Page Content  -->

</div>
