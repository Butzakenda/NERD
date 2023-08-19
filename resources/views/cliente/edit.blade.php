@extends('session')

@section('contenidoAT')
    <div class="container">
        <h2>Actualizar datos</h2>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-12 mb-5">
                <form method="POST" action="{{ route('cliente.update', $cliente->IdCliente) }}">
                    @csrf
                    @method('PUT')
                    <div class="row form-group">
                        <label class="form-label"   >Nombre:</label>
                        <input class="form-control" type="text" name="ActualizarNombreCliente" value="" placeholder="{{$cliente->Nombres}}">
                    </div>
                    <div class="row form-group">
                        <label class="form-label" >Apellidos:</label>
                        <input class="form-control" type="text" name="ActualizarApellidosCliente" value="" placeholder="{{$cliente->Apellidos}}">
                    </div>
                    <div class="row form-group">
                        <label class="form-label" >Teléfono:</label>
                        <input class="form-control" type="text" name="ActualizarTelefonoCliente" value="" placeholder="{{$cliente->Telefono}}">
                    </div>
                    <div class="row form-group">
                        <label class="form-label" >Correo Electrónico:</label>
                        <input class="form-control" type="text" name="ActualizarCorreoCliente" value="" placeholder="{{$cliente->CorreoELectronico}}">
                    </div>
                    <div class="row form-group">
                        <label class="form-label" >Número de documento:</label>
                        <input class="form-control" type="text" name="ActualizarDocumentoCliente" value="" placeholder="{{$cliente->Documento}}">
                    </div>
                    <div class="row form-group">
                        <label class="form-label" >Fecha de nacimiento:</label>
                        <input class="form-control" type="date" name="ActualizarFechaNaciCliente" value="{{$cliente->FechaNacimiento}}">
                    </div>
                    
                    <!-- Agrega aquí los campos que deseas editar -->
                    <button type="submit">Actualizar</button>
                </form>
                
            </div>
            
        </div>

        
        
        
    </div>
    
    
   
@endsection