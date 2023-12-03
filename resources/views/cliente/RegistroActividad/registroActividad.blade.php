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
                                <form action="{{ route('NotficacionesDetalles',[$noti->Tipo, Auth::user()->id]) }}" method="get">
                                    @csrf
                                    <button type="submit" class="btn btn-primary read">
                                        Más detalles
                                    </button>
                                </form>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>


@endsection
