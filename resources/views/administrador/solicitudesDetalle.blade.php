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
        @if (session('reject_success_message') && now() <= session('flash_lifetime'))
            <div class="alert alert-success">
                {{ session('reject_success_message') }}
            </div>
        @endif
        @if (session('reject_error_message') && now() <= session('flash_lifetime'))
            <div class="alert alert-warning">
                {{ session('reject_error_message') }}
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
                <div class="infoAdminDetalle   justify-content-center">
                    <h3>Detalles de la solicitud</h3>
                    <table class="table table-bordered">
                        @foreach ($DetalleSolicitud->solicitudes as $solicitud)
                            <tbody>
                                <tr>
                                    <td>Tipo Solicitud: </td>
                                    <td>
                                        {{ $solicitud->Tipo }} {{ $solicitud->IdSolicitud }}
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
                                <section>
                                    <div class="col-12">
                                        <div class="accordion" id="accordionExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                        aria-expanded="true" aria-controls="collapseOne">
                                                        Matricular producto o servicio:
                                                    </button>
                                                </h2>
                                                <div id="collapseOne" class="accordion-collapse collapse show"
                                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        @if ($solicitud->Estado == 'Rechazada')
                                                            <p>Esta solicitud ya ha sido rechazada</p>
                                                        @else
                                                            @if ($solicitud->Estado == 'Convocado a Entrevista')
                                                                <p>Ya convocado a entrevista para esta solicitud</p>
                                                            @else
                                                                <form
                                                                    action=" {{ route('solicitudes.servicio', $solicitud->IdSolicitud) }} "
                                                                    method="post">
                                                                    @csrf
                                                                    <p>Tenga en cuenta que para revertir esta acción se
                                                                        requiere
                                                                        enviar
                                                                        un correo: </p>
                                                                    <button>Matricular</button>
                                                                </form>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingTwo">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                        aria-expanded="false" aria-controls="collapseTwo">
                                                        Rechazar solicitud:
                                                    </button>
                                                </h2>
                                                <div id="collapseTwo" class="accordion-collapse collapse"
                                                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        @if ($solicitud->Estado == 'Rechazada')
                                                            <p>Esta solicitud ya ha sido rechazada</p>
                                                        @else
                                                            @if ($solicitud->Estado == 'Convocado a Entrevista')
                                                                <p>Ya convocado a entrevista para esta solicitud</p>
                                                            @else
                                                                <form
                                                                    action="{{ route('solicitudes.rejected', [$solicitud->IdSolicitud, $DetalleSolicitud->IdCliente]) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <p>Tipo de solicitud: {{ $solicitud->Tipo }}</p>
                                                                    <p>Describa el motivo de rechazo:</p>
                                                                    <textarea name="motivoRechazo" rows="8" cols="60"></textarea>
                                                                    <br>
                                                                    <button>Rechazar solicitud</button>
                                                                </form>
                                                            @endif
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingThree">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                        aria-expanded="false" aria-controls="collapseThree">
                                                        Citar a entrevista:
                                                    </button>
                                                </h2>
                                                <div id="collapseThree" class="accordion-collapse collapse"
                                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        @if ($solicitud->Estado == 'Rechazada')
                                                            <p>Esta solicitud ya ha sido rechazada</p>
                                                        @else
                                                            @if ($solicitud->Estado == 'En revisión')
                                                                <p>Se requiere un producto o servicio para realizar la
                                                                    entrevista
                                                                </p>
                                                            @else
                                                                <form
                                                                    action="{{ route('solicitudes.entrevista', $DetalleSolicitud->IdCliente) }}"
                                                                    method="get">
                                                                    @csrf
                                                                    <p>Citar a entrevista: </p>
                                                                    <button>Agendar</button>
                                                                </form>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingTwo">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                            aria-expanded="false" aria-controls="collapseTwo">
                                                            Entrevista:
                                                        </button>
                                                    </h2>
                                                    <div id="collapseFour" class="accordion-collapse collapse"
                                                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            {{-- @php
                                                                
                                                                /* $DetalleSolicitud->solicitudes as $MySolicitud */
                                                            @endphp
                                                            @foreach ($DetalleSolicitud->solicitudes as $MySolicitud) {
                                                                # code...
                                                            } --}}
                                                            {{-- {{dd($DetalleSolicitud->solicitudes)}} --}}

                                                            @if ($solicitud->Estado == 'Convocado a Entrevista')
                                                                @foreach ($DetalleSolicitud->solicitudes as $MySolicitud)
                                                                    
                                                                    <p>¿El aspirante aprobó la entrevista?</p>
                                                                    <form
                                                                        action="{{ route('solicitudes.EntrevistaAprobada', $MySolicitud->IdSolicitud) }}"
                                                                        class="form" method="post">
                                                                        @csrf
                                                                        
                                                                        <div class="form-group">
                                                                            <button
                                                                                class="btn btn-outline-success form-control">Aprobó</button>
                                                                        </div>
                                                                    </form>
                                                                    <br>
                                                                    <form
                                                                        action="{{ route('solicitudes.EntrevistaDenegada', $MySolicitud->IdSolicitud) }}"
                                                                        class="form" method="post">
                                                                        @csrf
                                                                        <div class="form-group">
                                                                            <button
                                                                                class="btn btn-outline-danger form-control">No
                                                                                aprobó</button>
                                                                        </div>
                                                                    </form>
                                                                @endforeach
                                                            @else
                                                                @if ($solicitud->Estado == 'Convocado a Entrevista')
                                                                    <p>Ya convocado a entrevista para esta solicitud</p>
                                                                @else
                                                                    <form
                                                                        action="{{ route('solicitudes.rejected', [$solicitud->IdSolicitud, $DetalleSolicitud->IdCliente]) }}"
                                                                        method="post">
                                                                        <div class="form-group">
                                                                            <p>Tipo de solicitud: {{ $solicitud->Tipo }}
                                                                            </p>
                                                                            <p>Describa el motivo de rechazo:</p>
                                                                            <textarea name="motivoRechazo" rows="8" cols="60"></textarea>
                                                                            <br>
                                                                            <button>Rechazar solicitud</button>
                                                                        </div>
                                                                        @csrf
                                                                    </form>
                                                                @endif
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                {{-- Estado = Convocado a entrevista --}}
                                <section>

                                </section>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
