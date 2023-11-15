@extends('session')

@section('contenidoAT')
    <div class="container">
        <div class="row">
            <h3>
                Formulario para citar a Entrevista
            </h3>
            <h4>
                Datos del cliente
            </h4>

            @foreach ($InfoClienteEntrevista as $info)
                <p>
                    Nombre : {{ $info->Nombres . ' ' . $info->Apellidos }}
                </p>
                <p>
                    Número de teléfono: {{ $info->Telefono }}
                </p>
                <p>
                    Correo Electrónico: {{ $info->CorreoELectronico }}
                </p>
                
                <form action="{{ route('solicitudes.agendarReunion',$info->IdCliente) }}">
                    <button>Agendar Cita</button>
                </form>
            @endforeach
        </div>
    </div>
@endsection
