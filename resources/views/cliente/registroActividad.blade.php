@extends('session')

@section('contenidoAT')
    @isset($notificaciones)
        <div class="container">
            <div class="row">
                @foreach ($notificaciones as $noti)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="header">
                                <span class="icon">
                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path clip-rule="evenodd"
                                            d="M18 3a1 1 0 00-1.447-.894L8.763 6H5a3 3 0 000 6h.28l1.771 5.316A1 1 0 008 18h1a1 1 0 001-1v-4.382l6.553 3.276A1 1 0 0018 15V3z"
                                            fill-rule="evenodd"></path>
                                    </svg>
                                </span>
                                <p class="alert">¡Nueva notificación!</p>
                            </div>

                            <p class="message">
                                Tipo: {{ $noti->Tipo }}
                            </p>
                            <p>
                                Descripción: {{ $noti->Descripcion }}
                            </p>
                            <div class="actions">
                                <a class="read" href="">
                                    Más detalles
                                </a>
                                <a class="mark-as-read" href="">
                                    Marcar como leído
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endisset
@endsection
