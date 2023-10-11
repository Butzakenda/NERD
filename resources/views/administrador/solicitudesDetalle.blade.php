@extends('session')

@section('contenidoAT')
    <div class="container-fluid ">
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
                                        {{ $solicitud->Tipo }}
                                    </td>
                                </tr>
                                <tr>
                                    <td> Fecha:</td>
                                    <td>{{ $solicitud->Fecha }}</td>
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
                                <div class="col-6">
                                    <form action="" method="post">
    
                                        <p>Matricular producto: </p>
                                        <button>Matricular</button>
                                    </form>
                                </div>
                                <div class="col-6">
                                    <form action="" method="get">
    
                                        <p>Citar a entrevista: </p>
                                        <button>Agendar</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
