
    <form action="{{route('cliente.enviarSolicitudAlianza')}}" method="post">
        @csrf
        <h1>Solicitud de Alianza</h1>
        <p>Hola, has recibido una solicitud de alianza:</p>
        <p><strong>Datos del cliente:</strong></p>
        <p>Nombre: {{$clienteSA->Nombres}} </p>
        <p>Apellidos: {{$clienteSA->Apellidos}} </p>
        <p>Correo electrónico: {{$clienteSA->CorreoELectronico}}</p>
        @if(!empty($clienteSA->Telefono))
            <p>Teléfono: {{$clienteSA->Telefono}} </p>
        @else
            <p>Teléfono: Debes asignar un Teléfono a tu cuenta, puedes actualizarlo desde la barra lateral izquierda en el Área de Trabajo</p>
        @endif
        <p><strong>Descripción del producto o servicio:</strong></p>
        <textarea name="descripcion" id="" cols="30" rows="10" value="">{{$descripcion}}</textarea>
        <button type="submit" >Enviar Solicitud</button>
    </form>
