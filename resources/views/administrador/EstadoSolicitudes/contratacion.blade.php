<div class="container">
    <div class="row">
        <h6 style="color: white;">
            Documentación:
        </h6 style="color: white;">
        <p style="color: white;">
            Estos son los documentos que el aspirante ha subido hasta el momento:
        </p>



        @foreach ($SeguimientoSolicitud as $seguimiento)
            <p style="color: white;">ID del Seguimiento: {{ $seguimiento->IdSeguimientoProductos }}</p>
            @foreach ($seguimiento->contratos as $contrato)
                @if (!is_null($hojaVidaPath))
                    <div class="row">
                        <h6 style="color: white;">
                            Hoja de vida:
                        </h6>
                        <div class="col-6">

                            <a href="{{ $hojaVidaPath }}" target="_blank" class="btn btn-primary my-2 ">Ver</a>
                            <a href="{{ $hojaVidaPath }}" download="{{ 'HojaVida.pdf' }}"
                                class="btn btn-success">Descargar</a>
                        </div>
                    </div>
                @else
                    <h6 style="color: white;">
                        Hoja de vida:
                    </h6>
                    <p class="texto">
                        No ha subido Hoja de vida
                    </p>
                @endif

                <div class="row">
                    @if (!is_null($seguroMedicoPath))
                        <section>

                            <h6 style="color: white;">
                                Seguro médico:
                            </h6>
                            <div class="col-6">

                                <a href="{{ $seguroMedicoPath }}" target="_blank" class="btn btn-primary my-2 ">Ver</a>
                                <a href="{{ $seguroMedicoPath }}" download="{{ 'SeguroMedico.pdf' }}"
                                    class="btn btn-success">Descargar</a>
                            </div>
                        </section>
                    @else
                        <h6 style="color: white;">
                            Seguro médico:
                        </h6>
                        <p class="texto">
                            No ha subido seguro médico
                        </p>
                    @endif
                </div>
                <div class="row">
                    @if (!is_null($documentoIdentificacionPath))
                        <h6 style="color: white;">
                            Cédula de ciudadanía:
                        </h6>
                        <div class="col-6">

                            <a href="{{ $documentoIdentificacionPath }}" target="_blank"
                                class="btn btn-primary my-2 ">Ver</a>
                            <a href="{{ $documentoIdentificacionPath }}" download="{{ 'Documento.pdf' }}"
                                class="btn btn-success">Descargar</a>
                        </div>
                    @else
                        <h6 style="color: white;">
                            Cédula de ciudadanía:
                        </h6>
                        <p class="texto">
                            No ha subido Cédula de ciudadanía
                        </p>
                    @endif
                </div>
            @endforeach
            <div class="row">
                <div class="col">
                    <form
                        action=" {{ route('contrato.colaborador', [$seguimiento->IdSeguimientoProductos, $DetalleSolicitud->IdCliente]) }} "
                        method="post">
                        @csrf
                        <h6 style="color: white;">Contratación</h6>
                        <p style="color: white;">
                            ¿Desea realizar la contratación?
                        </p>
                        <button class="btn btn-primary">Contratar</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
