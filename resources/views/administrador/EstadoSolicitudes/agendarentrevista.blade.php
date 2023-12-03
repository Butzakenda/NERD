<div class="container">
    <div class="row">
        <h5>
            Formulario para citar a Entrevista
        </h5>
        <h6>
            Datos del cliente
        </h6>
        @isset($DetalleSolicitud)
            <p>
                Nombre : {{ $DetalleSolicitud->Nombres . ' ' . $DetalleSolicitud->Apellidos }}
            </p>
            <p>
                Número de teléfono: {{ $DetalleSolicitud->Telefono }}
            </p>
            <p>
                Correo Electrónico: {{ $DetalleSolicitud->CorreoELectronico }}
            </p>
            @foreach ($DetalleSolicitud->solicitudes as $solicitud)
                <form action="{{ route('solicitudes.agendarReunion', [$solicitud->IdSolicitud,$DetalleSolicitud->IdCliente]) }}">
                    <button>Agendar Cita</button>
                </form>
            @endforeach
        @endisset
    </div>
</div>
