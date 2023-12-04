@extends('session')

@section('contenidoAT')
    <div class="container">
        <h1 class="texto">
            Mis Productos
        </h1>
        <p class="texto">
            Crear nuevo Producto:
        </p>
        <form action="{{route('productos.crearForm', Auth::user()->id)}}" method="get">
            @csrf

            <button class="btn btn-primary">
                Crear
            </button>
        </form>
        <br>
        <br>
        <table class="tablaSolicitudes">
            <thead>
                <th scope="col" style="width: 20%; color: white;">Nombre</th>
                <th scope="col" style="width: 20%; color: white;">Descripción</th>
                <th scope="col" style="width: 20%; color: white;">Foto</th>
                <th scope="col" style="width: 20%; color: white;">Precio</th>
                <th scope="col" style="width: 20%; color: white;">Acciones</th>
            </thead>
            <tbody class="tablaSolicitudes">
                @foreach ($colaborador->producto as $producto)
                    <tr class="fila-dato tablaSolicitudes">
                        <td scope="row " class="tablaSolicitudes">
                            <p>{{ $producto->Nombre }}</p>
                        </td>
                        <td scope="row" class="tablaSolicitudes">
                            <p>{{ $producto->Descripcion }}</p>
                        </td>
                        <td scope="row" class="tablaSolicitudes">
                            <p>
                                <a href="{{ $seguroMedicoPath }}" target="_blank" class="btn btn-primary">Ver</a>
                            <p>
                        </td>
                        <td scope="row" class="tablaSolicitudes">
                            <p>{{ $producto->Precio }}</p>
                        </td>
                        <td scope="row">
                            <form action="" method="get">
                                <button class="btn btn-info">Ver</button>
                            </form>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
@endsection
