@extends('session')

@section('contenidoAT')
    <div class="container-fluid ">
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

        <div class="infoCliente row">
            <div class="d-flex">
                {{-- {{dd($DetalleSolicitud->solicitudes)}} --}}
                <div class="infoClienteDetalle me-4">

                    <h3>Información del cliente</h3>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><strong>Información</strong></td>
                                <td><strong>Datos</strong></td>
                            </tr>
                            <tr>
                                <td>Nombres:</td>
                                <td>{{ $DetalleSolicitud->Nombres }}</td>
                            </tr>
                            <tr>
                                <td>Apellidos:</td>
                                <td>{{ $DetalleSolicitud->Apellidos }}</td>
                            </tr>
                            <tr>
                                <td>Ciudad:</td>
                                <td>{{ $DetalleSolicitud->Ciudad->Nombre }}</td>
                            </tr>
                            <tr>
                                <td>Departamento:</td>
                                <td>{{ $DetalleSolicitud->Departamento->Nombre }}</td>
                            </tr>
                            <tr>
                                <td>Tipo de Documento:</td>
                                <td>{{ $DetalleSolicitud->tipoDocumento }}</td>
                            </tr>
                            <tr>
                                <td>Número de Documento:</td>
                                <td>{{ $DetalleSolicitud->Documento }}</td>
                            </tr>
                            <tr>
                                <td>Correo electrónico:</td>
                                <td>{{ $DetalleSolicitud->CorreoELectronico }}</td>
                            </tr>
                            <tr>
                                <td>Teléfono:</td>
                                <td>{{ $DetalleSolicitud->Telefono }}</td>
                            </tr>
                            <tr>
                                <td>Fecha de nacimiento:</td>
                                <td>{{ $DetalleSolicitud->FechaNacimiento }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="infoAdminDetalle  justify-content-center">
                    <h3>Detalles de la solicitud</h3>
                    <table class="table table-bordered">
                        @foreach ($DetalleSolicitud->solicitudes as $solicitud)
                            <tbody>
                                <tr>
                                    <td>Tipo Solicitud: </td>
                                    <td>
                                        {{ $solicitud->Tipo }}
                                    </td>
                                </tr>

                                <tr>
                                    <td> Fecha:</td>
                                    <td>{{ $solicitud->Fecha }}</td>
                                </tr>
                                <tr>
                                    <td> Estado:</td>
                                    <td>{{ $solicitud->Estado }}</td>
                                </tr>
                                @if ($solicitud->Estado == 'Rechazada')
                                    @if ($notificacionesCliente)
                                        <tr>
                                            <td> Observaciones:</td>
                                            <td>{{ $notificacionesCliente->Descripcion }}</td>
                                        </tr>
                                    @endif
                                @endif
                                <tr>
                                    <td>Nombre producto: </td>
                                    <td>
                                        {{ $solicitud->Nombre }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Descripción:</td>
                                    <td>{{ $solicitud->Descripcion }}</td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                    <div class="d-flex">

                        <div class="row">
                            <div class="row">
                                <h4>
                                    Acciones:
                                </h4>
                            </div>
                            <div class="row">
                                {{-- Estado = En revisión --}}
                                <section class="">
                                    <div class="col-12 ">
                                        @if ($solicitud->Estado == 'En revisión')
                                            @include('administrador.EstadoSolicitudes.enrevision')
                                        @elseif ($solicitud->Estado == 'Convocado a Entrevista')
                                            @include('administrador.EstadoSolicitudes.agendarentrevista')
                                        @elseif ($solicitud->Estado == 'Entrevista no aprobada' || $solicitud->Estado == 'Rechazada')
                                            @include('administrador.EstadoSolicitudes.rechazada')
                                        @elseif ($solicitud->Estado == 'Entrevista')
                                            @include('administrador.EstadoSolicitudes.entrevista')
                                        @elseif ($solicitud->Estado == 'En proceso de contratación')
                                            @include('administrador.EstadoSolicitudes.contratacion')
                                        @elseif($solicitud->Estado == 'Contratado')
                                            @include('administrador.EstadoSolicitudes.contratado')
                                        @else
                                            <h5>Algo ha salido mal...</h5>
                                        @endif
                                    </div>
                                

                                </section>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
