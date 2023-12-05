{{-- Esta vista es la que se muestra cuando el usuario se ha autenticado y selecciona la opción 
     de solicitar alianza en el área de trabajo 
     La variable proviene del controlador ClienteController
     El formulario apunta al método create en el controlador SolicitudesController
     --}}
@extends('session')

@section('contenidoAT')
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
    <form action="{{ route('cliente.crearSolicitudAlianza') }}" method="post">
        @csrf
        <h1 style="color: white" >Solicitud de Alianza</h1>
        <p style="color: white" >Hola, esta es una solicitud de alianza:</p>
        <p style="color: white" ><strong>Datos del cliente:</strong></p>
        <p style="color: white" >Nombre: {{ $clienteSA->Nombres }} </p>
        <p style="color: white" >Apellidos: {{ $clienteSA->Apellidos }} </p>
        <p style="color: white" >Correo electrónico: {{ $clienteSA->CorreoELectronico }}</p>
        @if (!empty($clienteSA->Telefono))
            <p style="color: white" >Teléfono: {{ $clienteSA->Telefono }} </p>
        @else
            <p style="color: white" >Teléfono: Debes asignar un Teléfono a tu cuenta, puedes actualizarlo desde la barra lateral izquierda en el
                Área de Trabajo</p>
        @endif

        <label style="color: white"  for="">Nombre del producto</label>
        <input type="text" class="form-control" name="nombreProductoSA">
        <p style="color: white" ><strong>Descripción del producto o servicio:</strong></p>
        <textarea name="descripcionProductoSA" class="form-control" id="" cols="30" rows="10" value="">{{ $descripcion }}</textarea>
        <br>
        <button class="btn btn-primary " type="submit">Enviar Solicitud</button>
    </form>
@endsection
