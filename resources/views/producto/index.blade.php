@extends('session')

@section('contenidoAT')
<div class="container-flex">
    @isset($productos)
    @foreach ($productos as $producto)
    <div id="" class="row" >
        <div class="col-12 d-flex">
            <div class="col-2"></div>
            <div class="col-6 mb-3" style="border: 2px solid black">
                <a  href="" style="text-decoration: none; color:black" >
                    <div class="col-12 userdescription d-flex flex-row">
                        <div class="row">
                            <div class="col-2">
                                <img align="left" src="{{ asset('img/user.png') }}" alt="User Image" class="img-fluid" style="width=30">
                            </div>
                            <div class="col-8 d-flex">
                                <p style="display: flex;"> 
                                    {{ $producto->colaborador->Nombres . " " . $producto->colaborador->Apellidos }}                                                           
                                </p>
                                <div class="col-2">
                                    <img align="left" src="{{ asset('img/penguin.png') }}" alt="User Image" class="img-fluid" style="width=30">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-12">
                                    <p>
                                        {{ $producto->Nombre }}
                                    </p>
                                    {{-- <p>
                                        @if ($producto->colaborador->departamento)
                                            {{ $producto->colaborador->departamento->Nombre }}
                                        @endif

                                    </p> --}}
                                </div>  
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="productoDescription">
                                        <p>
                                            {{ $producto->Descripcion }}
                                        </p>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        
                    </div>                                                
         
            </a>
            </div>
            
        </div>
    </div>
    @endforeach
    <div class="row">
        <div class="col-6 ">
            <div class="col-6">
                {{ $productos->links('pagination::bootstrap-4') }} <!-- Muestra los enlaces de paginación -->
            </div>
        </div>
    </div>
    
    @endisset

    
    
</div>
@endsection
