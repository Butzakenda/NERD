{{-- Esta vista es la que se muestra cuando el usuario se ha autenticado y selecciona la opción 
     de actualizar datos en el área de trabajo 
     La variable proviene del controlador ClienteController
     El formulario apunta al método update en el controlador ClienteController y se apoya del método
     edit, también de ClienteController
     --}}

@extends('session')

@section('contenidoAT')
    <div class="container">
        @if (session('success_message') && now() <= session('flash_lifetime'))
            <div class="alert alert-success">
                {{ session('success_message') }}
            </div>
        @endif
        @if (session('error_message') && now() <= session('flash_lifetime'))
            <div class="alert alert-warning">
                {{ session('error_message') }}
            </div>
        @endif
        <h2  style="color: white" >Actualizar datos</h2>
        <div class="row">
            <div class="col-12 mb-5">
                <form method="POST" action="{{ route('colaborador.update', $colaborador->IdColaborador) }}">
                    @csrf
                    @method('PUT')
                    <div class="row form-group">
                        <label style="color: white" class="form-label"   >Nombre:</label>
                        <input class="form-control" type="text" name="ActualizarNombreCliente" value="" placeholder="{{$colaborador->Nombres}}">
                    </div>
                    <div class="row form-group">
                        <label  style="color: white" class="form-label" >Apellidos:</label>
                        <input class="form-control" type="text" name="ActualizarApellidosCliente" value="" placeholder="{{$colaborador->Apellidos}}">
                    </div>
                    <div class="row form-group">
                        <label  style="color: white" class="form-label" >Teléfono:</label>
                        <input class="form-control" type="text" name="ActualizarTelefonoCliente" value="" placeholder="{{$colaborador->Telefono}}">
                    </div>
                    <div class="row form-group">
                        <label  style="color: white" class="form-label" >Correo Electrónico:</label>
                        <input class="form-control" type="text" name="ActualizarCorreoCliente" value="" placeholder="{{$colaborador->CorreoELectronico}}">
                    </div>
                    <div class="row form-group">
                        <label  style="color: white" class="form-label" >Número de documento:</label>
                        <input class="form-control" type="text" name="ActualizarDocumentoCliente" value="" placeholder="{{$colaborador->Documento}}">
                    </div>
                    <div class="row form-group">
                        <label  style="color: white" class="form-label" >Fecha de nacimiento:</label>
                        <input class="form-control" type="date" name="ActualizarFechaNaciCliente" value="{{$colaborador->FechaNacimiento}}">
                    </div>
                    <br>
                    <!-- Agrega aquí los campos que deseas editar -->
                    <button class="btn btn-primary""  type="submit">Actualizar</button>
                </form>
                
            </div>
            
        </div>

        
        
        
    </div>
    
    
   
@endsection