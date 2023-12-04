@extends('index')

@section('contenido')
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
                            <a href="" style="text-decoration: none; color:black">
                                <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">

                                    <div class="col-12 userdescription d-flex flex-row" data-bs-ride="carousel">
                                        @foreach ($productoChunks[$i] as $producto)
                                            <div class="row carousel-inner card">
                                                <div class="row">
                                                    <div class="col-3 ">
                                                        <img align="left" src="{{ asset('img/user.png') }}" alt="User Image"
                                                            class="card-img-top card-img" style="width=30">
                                                    </div>
                                                    <div class="col-6">
                                                        <p style="display: flex; color: black;" class="card-text titulo">
                                                            {{ $producto->colaborador->Nombres . ' ' . $producto->colaborador->Apellidos }}
                                                        </p>
                                                    </div>
                                                    <div class="col-3">
                                                        <img align="left" src="{{ asset($producto->colaborador->Foto) }}"
                                                            alt="User Image" class="img-fluid" style="width=30">
                                                    </div>
                                                </div>
                                                <div class="row" style="">
                                                    <div class="col-12">
                                                        <p class="titulo card-title" style="color: black;">
                                                            {{ $producto->Nombre }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row" style="">
                                                    <div class="col-12">
                                                        <div class="productoDescription titulo card-text">
                                                            <p style="color: black;">>
                                                                {{ $producto->Descripcion }} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </a>
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
