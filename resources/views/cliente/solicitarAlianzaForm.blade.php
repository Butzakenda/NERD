{{-- Esta vista es la que se muestra cuando el usuario se ha autenticado y selecciona la opción 
     de solicitar alianza en el área de trabajo 
     La variable proviene del controlador ClienteController
     El formulario apunta al método create en el controlador SolicitudesController
     --}}
@extends('session')

@section('contenidoAT')

    <form action="{{route('cliente.crearSolicitudAlianza')}}" method="post">
        @csrf
        <h1>Solicitud de Alianza</h1>
        <p>Hola, esta es una solicitud de alianza:</p>
        <p><strong>Datos del cliente:</strong></p>
        <p>Nombre: {{$clienteSA->Nombres}} </p>
        <p>Apellidos: {{$clienteSA->Apellidos}} </p>
        <p>Correo electrónico: {{$clienteSA->CorreoELectronico}}</p>
        @if(!empty($clienteSA->Telefono))
            <p>Teléfono: {{$clienteSA->Telefono}} </p>
        @else
            <p>Teléfono: Debes asignar un Teléfono a tu cuenta, puedes actualizarlo desde la barra lateral izquierda en el Área de Trabajo</p>
        @endif
        
        <label for="">Nombre del producto</label>
        <input type="text" name="nombreProductoSA">
        <p><strong>Descripción del producto o servicio:</strong></p>
        <textarea name="descripcionProductoSA" id="" cols="30" rows="10" value="">{{$descripcion}}</textarea>
        <button type="submit" >Enviar Solicitud</button>
    </form>
@endsection