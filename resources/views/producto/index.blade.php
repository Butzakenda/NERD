@extends('session')

@section('contenidoAT')
    <link rel="stylesheet" href=" {{ asset('css/Productos.css') }} ">
    <div class="container contenidoHeader">
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
        <h1>Productos</h1>
        @isset($productos)
            <div class="container">
                <div class="row mr-md-3 g-4">
                    @foreach ($productos as $index => $producto)
                        <div class="col">
                            <div class="card ">
                                @if (!is_null($producto->fotoPathConNombre))
                                    <img src="{{ asset($producto->fotoPathConNombre) }}" class="card-img-top card-img"
                                        alt="User Image" style="object-fit: contain; height: 100px;">
                                @else
                                    <img src="{{ asset('img/man.png') }}" class="card-img-top card-img" alt="User Image"
                                        style="object-fit: contain; height: 100px;">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $producto->Nombre }}</h5>
                                    <div id="card-text">
                                        <p class="card-text">{{ $producto->Descripcion }}</p>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <span class="text-muted">$ {{ $producto->Precio }}</span>
                                    <button class="card-btn" data-bs-toggle="modal"
                                        data-bs-target="#compraProducto{{ $index }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path
                                                d="m397.78 316h-205.13a15 15 0 0 1 -14.65-11.67l-34.54-150.48a15 15 0 0 1 14.62-18.36h274.27a15 15 0 0 1 14.65 18.36l-34.6 150.48a15 15 0 0 1 -14.62 11.67zm-193.19-30h181.25l27.67-120.48h-236.6z">
                                            </path>
                                            <path
                                                d="m222 450a57.48 57.48 0 1 1 57.48-57.48 57.54 57.54 0 0 1 -57.48 57.48zm0-84.95a27.48 27.48 0 1 0 27.48 27.47 27.5 27.5 0 0 0 -27.48-27.47z">
                                            </path>
                                            <path
                                                d="m368.42 450a57.48 57.48 0 1 1 57.48-57.48 57.54 57.54 0 0 1 -57.48 57.48zm0-84.95a27.48 27.48 0 1 0 27.48 27.47 27.5 27.5 0 0 0 -27.48-27.47z">
                                            </path>
                                            <path
                                                d="m158.08 165.49a15 15 0 0 1 -14.23-10.26l-25.71-77.23h-47.44a15 15 0 1 1 0-30h58.3a15 15 0 0 1 14.23 10.26l29.13 87.49a15 15 0 0 1 -14.23 19.74z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        @include('partials.modalProducto')
                    @endforeach
                </div>
            </div>

            <div class="row">
                <div class="col-6 ">
                    <div class="col-6">
                        {{ $productos->links('pagination::bootstrap-4') }} <!-- Muestra los enlaces de paginación -->
                    </div>
                </div>
            </div>

        </div>
    @endisset
@endsection
