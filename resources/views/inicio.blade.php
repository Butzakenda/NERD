@extends('index')

@section('contenido')
<div class="container-fluid">
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
                    <div class="col-12 userdescription d-flex flex-row" data-bs-ride="carousel">
                        @foreach ($productoChunks[$i] as $producto)

                            <div class="row carousel-inner" >
                                <div class="row" >
                                    <div class="col-3 ">
                                        <img align="left" src="{{ asset('img/user.png') }}" alt="User Image" class="img-fluid" style="width=30">
                                        
                                            
                                    </div>
                                    <div class="col-6">
                                        <p style="display: flex;"> 
                                            {{ $producto->colaborador->Nombres . " " . $producto->colaborador->Apellidos }}                                                           
                                        </p>
                                    </div>
                                    <div class="col-3">
                                        
                                                <img align="left" src="{{ asset('img/penguin.png') }}" alt="User Image" class="img-fluid" style="width=30">
                                            
                                        
                                    </div>
                                </div>
                                <div class="row" style="">
                                    <div class="col-12">
                                        <p>
                                            {{$producto->Nombre}}
                                        </p>
                                    </div>  
                                </div>
                                <div class="row" style="">
                                    <div class="col-12">
                                        <div class="productoDescription">
                                            <p>
                                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Temporibus culpa rerum doloribus ipsam eum cumque necessitatibus blanditiis illum aliquam reprehenderit ullam non, dolore, atque ipsum quam maxime esse.
                                            </p>
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
                <a class="carousel-control-prev custom-carousel-control" href="#carouselRecientes" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next custom-carousel-control" href="#carouselRecientes" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection