@extends('session')

@section('contenidoAT')
    @if (session('success_message') && now() <= session('flash_lifetime'))
        <div class="alert alert-success">
            {{ session('success_message') }}
        </div>
    @endif
    @if (session('error_message') && now() <= session('flash_lifetime'))
        <div class="alert alert-warning">
            {{ session('error_message') }}
        </div>
    @endif
    <div class="documentacion">
        <h2 class="texto">
            Documentación para contrato - NERD
        </h2>
        <h6 class="texto">
            Estimado cliente:
        </h6>
        <p class="texto">
            Estamos muy felices de contar con tu ayuda en NERD, pero antes debes
            adjuntar unos documentos para finalizar el proceso de contratación.
            Seguramente uno de nuestros empleados te habló de ello durante la entrevista,
            debes subir tu hoja de vida (asegúrate de incluir todos tus certificados de
            estudio,
            si cuentas con estos, dentro de la hoja de vida), tu seguro médico (si no
            cuentas
            con uno,
            puedes subir tu certificado del SISBEN) y por último una copia de tu Cédula de
            Ciudadanía.
            Una vez subas todos los documentos se te indicarán los siguientes pasos:
        </p>
        <form action="{{ route('documentos.contrato', Auth::user()->id) }}" id="documentosForm" method="post"
            enctype="multipart/form-data">
            @csrf
            <p class="texto">Seleccione el seguimiento de producto al que desea llevar los documentos de la siguiente lista desplegable.
                Aquí encontrará el nombre de los productos que han sido matriculados:
            </p>


            @isset($seguimientos)
                <select name="seguimiento_id" id="seguimiento_id" class="form-select">
                    @foreach ($seguimientos as $seguimiento)
                        <option value=" {{ $seguimiento->solicitud->IdSolicitud }} "> {{ $seguimiento->solicitud->Nombre }}
                        </option>
                    @endforeach
                </select>
            @endisset


            <!-- Input para Hoja de Vida -->
            <div class="mb-3">
                <label for="hojaVida" class="form-label texto">Selecciona tu Hoja de Vida:</label>
                <input type="file" class="form-control" id="hojaVida" name="hojaVida" required>
                <small class=" texto">Formatos permitidos: PDF</small>
            </div>

            <!-- Input para Seguro Médico -->
            <div class="mb-3">
                <label for="seguroMedico" class="form-label texto">Selecciona tu Seguro
                    Médico:</label>
                <input type="file" class="form-control" id="seguroMedico" name="seguroMedico" required>
                <small class=" texto">Formatos permitidos: PDF</small>
            </div>

            <!-- Input para Documento de Identificación -->
            <div class="mb-3">
                <label for="documentoIdentificacion" class="form-label texto">Selecciona tu
                    Documento
                    de
                    Identificación:</label>
                <input type="file" class="form-control" id="documentoIdentificacion" name="documentoIdentificacion"
                    required>
                <small class=" texto">Formatos permitidos: PDF</small>
            </div>
            <button class="btn btn-primary">Enviar Documentos</button>
        </form>
    </div>
@endsection
