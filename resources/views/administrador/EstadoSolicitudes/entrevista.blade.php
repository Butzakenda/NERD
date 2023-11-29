@foreach ($DetalleSolicitud->solicitudes as $MySolicitud)
    <h5>Entrevista</h5>
    <p>¿El aspirante aprobó la entrevista?</p>
    <form action="{{ route('solicitudes.EntrevistaAprobada', $MySolicitud->IdSolicitud) }}" class="form" method="post">
        @csrf

        <div class="form-group">
            <button class="btn btn-outline-success form-control">Aprobó</button>
        </div>
    </form>
    <br>
    <form action="{{ route('solicitudes.EntrevistaDenegada', $MySolicitud->IdSolicitud) }}" class="form" method="post">
        @csrf
        <div class="form-group">
            <button class="btn btn-outline-danger form-control">No
                aprobó</button>
        </div>
    </form>
@endforeach
