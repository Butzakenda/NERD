<div class="container">
    <div class="row">
        <h5 style="color: white;">
            Formulario para citar a Entrevista
        </h5>
        <h6 style="color: white;">
            Datos del cliente
        </h6>
        @isset($DetalleSolicitud)
            <p style="color: white;">
                Nombre : {{ $DetalleSolicitud->Nombres . ' ' . $DetalleSolicitud->Apellidos }}
            </p>
            <p style="color: white;">
                Número de teléfono: {{ $DetalleSolicitud->Telefono }}
            </p>
            <p style="color: white;">
                Correo Electrónico: {{ $DetalleSolicitud->CorreoELectronico }}
            </p>
            @foreach ($DetalleSolicitud->solicitudes as $solicitud)
                <form action="{{ route('solicitudes.agendarReunion', [$solicitud->IdSolicitud,$DetalleSolicitud->IdCliente]) }}">
                    <button class="btn btn-outline-light">Agendar Cita</button>
                </form>
            @endforeach
        @endisset
    </div>
</div>
