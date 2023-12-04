<div class="col">
    <form action="{{ route('solicitudes.entrevista', $DetalleSolicitud->IdCliente) }}" method="get">
        @csrf
        <p style="color: white;">Citar a entrevista: </p>
        <button>Agendar</button>
    </form>
</div>
