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

            <form action="{{ route('solicitudes.agendarReunion', $DetalleSolicitud->IdCliente) }}">
                <button>Agendar Cita</button>
            </form>
        @endisset
    </div>
</div>
