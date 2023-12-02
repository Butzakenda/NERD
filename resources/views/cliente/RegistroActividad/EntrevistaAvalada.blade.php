@extends('session')

@section('contenidoAT')
    <div class="documentacion">
        <h2>
            Documentación para contrato - NERD
        </h2>
        <h6>
            Estimado cliente:
        </h6>
        <p>
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
        <form action="{{ route('documentos.contrato') }}" id="documentosForm" method="post" enctype="multipart/form-data">
            @csrf

            <!-- Input para Hoja de Vida -->
            <div class="mb-3">
                <label for="hojaVida" class="form-label">Selecciona tu Hoja de Vida:</label>
                <input type="file" class="form-control" id="hojaVida" name="hojaVida" required>
                <small class="text-muted">Formatos permitidos: PDF</small>
            </div>

            <!-- Input para Seguro Médico -->
            <div class="mb-3">
                <label for="seguroMedico" class="form-label">Selecciona tu Seguro
                    Médico:</label>
                <input type="file" class="form-control" id="seguroMedico" name="seguroMedico" required>
                <small class="text-muted">Formatos permitidos: PDF</small>
            </div>

            <!-- Input para Documento de Identificación -->
            <div class="mb-3">
                <label for="documentoIdentificacion" class="form-label">Selecciona tu
                    Documento
                    de
                    Identificación:</label>
                <input type="file" class="form-control" id="documentoIdentificacion" name="documentoIdentificacion"
                    required>
                <small class="text-muted">Formatos permitidos: PDF</small>
            </div>
            <button class="btn btn-primary" >Enviar Documentos</button>
        </form>
    </div>
@endsection
