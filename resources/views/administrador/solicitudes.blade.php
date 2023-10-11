@extends('session')

@section('contenidoAT')
    <div class="container">
        <h3>Solicitudes:</h3>
        {{-- {{dd($solicitudes)}}   --}}
        @foreach ($solicitudes as $solicitud)
            <table class="table">
                <thead>
                    <th scope="col">Tipo de solicitud</th>
                    <th scope="col">Nombres y Apellidos Cliente</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Administrador encargado</th>
                    <th scope="col">Fecha</th>
                </thead>
                <tbody>
                    <tr class="fila-dato">
                        <td scope="row">
                            <p>{{ $solicitud->Tipo }}</p>
                        </td>
                        <td scope="row">
                            <p> {{ $solicitud->cliente->Nombres . ' ' . $solicitud->cliente->Apellidos }}</p>
                        </td>
                        <td scope="row">
                            <p>{{ $solicitud->Estado }}</p>
                        </td>
                        <td scope="row">
                            @isset($solicitud->administrador->Nombres)
                                {{ $solicitud->administrador->IdAdministrador . '. ' . $solicitud->administrador->Nombres . ' ' . $solicitud->administrador->Apellidos }}
                            @else
                                No asignado
                            @endisset
                        </td>
                        <td scope="row">
                            <p>{{ $solicitud->Fecha }}</p>
                        </td>
                        <td scope="row">
                            <form action=" {{route('solicitudes.ver',$solicitud->cliente->IdCliente)}} " method="get">
                                <button class="btn btn-info" >Ver</button>
                            </form>
                        </td>
                    </tr>
                    <!-- Repite la estructura anterior para cada registro -->
                </tbody>
            </table>
        @endforeach
    </div>
@endsection
