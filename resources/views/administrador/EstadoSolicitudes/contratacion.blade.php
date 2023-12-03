<div class="container">
    <div class="row">
        <h6>
            Documentación:
        </h6>
        <p>
            Estos son los documentos que el aspirante ha subido hasta el momento:
        </p>

        @foreach ($SeguimientoSolicitud as $seguimiento)
            <p>ID del Seguimiento: {{ $seguimiento->IdSeguimientoProductos }}</p>
            @foreach ($seguimiento->contratos as $contrato)
                <div class="row">
                    <h6>
                        Hoja de vida:
                    </h6>
                    <a href="{{ $hojaVidaPath }}" target="_blank" class="btn btn-primary">Ver</a>
                    <a href="{{ $hojaVidaPath }}" download="{{ 'HojaVida.pdf' }}" class="btn btn-success">Descargar</a>
                </div>
                <div class="row">
                    <h6>
                        Seguro médico:
                    </h6>
                    <a href="{{ $seguroMedicoPath }}" target="_blank" class="btn btn-primary">Ver</a>
                    <a href="{{ $seguroMedicoPath }}" download="{{ 'SeguroMedico.pdf' }}"
                        class="btn btn-success">Descargar</a>
                </div>
                <div class="row">
                    <h6>
                        Cédula de ciudadanía:
                    </h6>
                    <a href="{{ $documentoIdentificacionPath }}" target="_blank" class="btn btn-primary">Ver</a>
                    <a href="{{ $documentoIdentificacionPath }}" download="{{ 'Documento.pdf' }}"
                        class="btn btn-success">Descargar</a>
                </div>
            @endforeach
            <div class="row">
                <div class="col">
                    <form
                        action=" {{ route('contrato.colaborador', [$seguimiento->IdSeguimientoProductos, $DetalleSolicitud->IdCliente]) }} "
                        method="post">
                        @csrf
                        <h6>Contratación</h6>
                        <p>
                            ¿Desea realizar la contratación?
                        </p>
                        <button class="btn btn-primary">Contratar</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
