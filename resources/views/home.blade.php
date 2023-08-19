@extends('index')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav id="sidebar" class="bg-light">
          <div class="p-4">
            <h4>Sidebar</h4>
            <ul class="list-unstyled">
              <li><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                Actualizar Perfil
              </button></li>
              <li><a href="#">Solicitar Alianza</a></li>
              <li><a href="#">Desactivar cuenta</a></li>
              <li><a href="#">Registro de actividad</a></li>
            </ul>
          </div>
        </nav>
        
        <!-- Page Content -->
        <div id="content" class="p-4">
          <h2>Main Content</h2>
          <p>This is the main content area.</p>
        </div>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
      
  
      <!-- Ventana Modal -->
      <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <!-- Encabezado de la modal -->
            <div class="modal-header">
              <h5 class="modal-title">Mi Ventana Modal</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            
            <!-- Contenido de la modal -->
            <div class="modal-body">
              <p>Este es el contenido de la ventana modal. Puedes agregar lo que quieras aquí.</p>
            </div>
            
            <!-- Pie de página de la modal -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary">Guardar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  
</div>
@endsection
