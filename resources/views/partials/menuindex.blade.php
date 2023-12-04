<nav class="navbar navbar-expand-lg navbar-dark  navbar">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{route('sesion.index')}}">NERD</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            
            @if (Route::has('login'))
                      
                <a class="nav-link active" aria-current="page" href="{{route('sesion.index')}}">Inicio</a>     
            @else
                <a class="nav-link active" aria-current="page" href="inicio">Inicio</a>
            @endif
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Nosotros
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Misión</a></li>
              <li><a class="dropdown-item" href="#">Visión</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Proyección 2024</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href=" {{route('productos.index')}} ">Productos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="  ">PQR</a>
          </li>
          
          <li class="nav-item">
            
          </ul>
          </li>
        </ul>
        {{-- {{dd(Request::is('sesion.index') || Request::is('productos.index'))}} --}}
        {{-- @if (Request::is('sesion.index') || Request::is('productos.index')) --}}
            <form class="d-flex" role="search" method="GET" action="{{ route('buscar') }}">
                <input name="buscar" class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar" value="{{ $busqueda ?? '' }}">
                <button style="color: white; border: 1px solid white" class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
        {{-- @endif --}}

          
      </div>
      <div class="ContainerLoginAuth d-flex" >
        @if (Route::has('login'))
            <div class="LoginAuth sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                    <a href="{{ url('/session') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Área de Trabajo</a>
                @else
                    <a href="{{ route('login.index') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('departamentos.index') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif
       
          <!-- Authentication Links -->
          
      </div>
        
    </div>
  </nav>