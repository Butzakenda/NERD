<div class="modal fade" id="detallesModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"  data-bs-config={backdrop:true}>>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalles de la notificación - {{ $noti->Tipo }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               {{--  @include("cliente.RegistroActividad.{$noti->Tipo}", ['noti' => $noti]) --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="enviarDocumentosBtnModal"
                    name="enviarDocumentosBtnModal">
                    Enviar Documentos
                </button>
            </div>
        </div>
    </div>
</div>
