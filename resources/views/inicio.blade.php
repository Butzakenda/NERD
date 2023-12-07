@extends('index')

@section('contenido')
    <link rel="stylesheet" href=" {{ asset('css/Productos.css') }} ">

    <div class="container-fluid branchHeader">
        <div class="row">
            <div class="col-12 titulo">
                <h1>
                    Revisa nuestro Boletín Semanal y encuentra
                    las publicaciones más recientes
                </h1>
            </div>
        </div>

        <div class="col-12 boxrecientes carousel slide">
            <div id="carouselRecientes" class="carousel slide">
                <div class="carousel-inner">
                    @isset($productoChunks)
                        @for ($i = 0; $i < count($productoChunks); $i++)
                            <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                                <div class="col-12 userdescription d-flex " data-bs-ride="carousel">
                                    @foreach ($productoChunks[$i] as $producto)
                                        <div class="container">
                                            <div class="row ">
                                                <div class="col">
                                                    <div class="card ">
                                                        @if (!is_null($producto->fotoPathConNombre))
                                                            <img src="{{ asset($producto->fotoPathConNombre) }}"
                                                                class="card-img-top card-img" alt="User Image"
                                                                style="object-fit: contain; height: 100px;">
                                                        @else
                                                            <img src="{{ asset('img/man.png') }}" class="card-img-top card-img"
                                                                alt="User Image" style="object-fit: contain; height: 100px;">
                                                        @endif
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $producto->Nombre }}</h5>
                                                            <div id="card-text">
                                                                <p class="card-text">{{ $producto->Descripcion }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <span class="text-muted">$ {{ $producto->Precio }}</span>
                                                            {{-- <button class="card-btn">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 512 512">
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
                                                                </button> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endfor
                    @endisset
                </div>
                <div class="carousel-controls-container">
                    <a class="carousel-control-prev custom-carousel-control" href="#carouselRecientes" role="button"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next custom-carousel-control" href="#carouselRecientes" role="button"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
