<div class="container">
    <div class="row">

        <div class="col">
            <form action="{{ route('solicitudes.entrevista', $DetalleSolicitud->IdCliente) }}" method="get">
                @csrf
                <p style="color: white;">Citar a entrevista: </p>
                <button class="btn btn-outline-success">Agendar</button>
            </form>
        </div>
    </div>
</div>
