@extends('session')

@section('contenidoAT')
    <div class="container">
        <h3>Solicitudes:</h3>
        {{-- {{dd($solicitudes)}}   --}}
        <table class="tablaSolicitudes">
            <thead>
                <th scope="col" style="width: 20%; color: white;">Tipo de solicitud</th>
                <th scope="col" style="width: 25%; color: white;">Nombres y Apellidos Cliente</th>
                <th scope="col" style="width: 15%; color: white;">Estado</th>
                <th scope="col" style="width: 25%; color: white;">Administrador encargado</th>
                <th scope="col" style="width: 15%; color: white;">Fecha</th>
                <th scope="col" style="width: 5%; color: white;">Acciones</th>
            </thead>
            <tbody class="tablaSolicitudes">
                @foreach ($solicitudes as $solicitud)
                    <tr class="fila-dato tablaSolicitudes">
                        <td scope="row " class="tablaSolicitudes">
                            <p>{{ $solicitud->Tipo }}</p>
                        </td>
                        <td scope="row" class="tablaSolicitudes">
                            <p>{{ $solicitud->cliente->Nombres . ' ' . $solicitud->cliente->Apellidos }}</p>
                        </td>
                        <td scope="row" class="tablaSolicitudes">
                            <p>{{ $solicitud->Estado }}</p>
                        </td>
                        <td scope="row" class="tablaSolicitudes">
                            @isset($solicitud->administrador->Nombres)
                                <p>

                                    {{ $solicitud->administrador->IdAdministrador . '. ' . $solicitud->administrador->Nombres . ' ' . $solicitud->administrador->Apellidos }}
                                </p>
                            @else
                                <p>

                                    No asignado
                                </p>
                            @endisset
                        </td>
                        <td scope="row" class="tablaSolicitudes">
                            <p>{{ $solicitud->Fecha }}</p>
                        </td>
                        <td scope="row">
                            <form action="{{ route('solicitudes.ver', [$solicitud->cliente->IdCliente, $solicitud->IdSolicitud]) }}" method="get">
                                <button class="btn btn-info">Ver</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
@endsection
