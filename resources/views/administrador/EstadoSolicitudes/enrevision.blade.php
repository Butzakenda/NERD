@if ($solicitud->IdAdministrador)
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    Matricular producto o servicio:
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action=" {{ route('solicitudes.servicio', $solicitud->IdSolicitud) }} " method="post">
                        @csrf
                        <h5>Matricular Producto</h4>
                            <p>Tenga en cuenta que para revertir esta acción se
                                requiere
                                enviar
                                un correo: </p>
                            <button>Matricular</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Rechazar prodcuto o servicio
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form
                        action="{{ route('solicitudes.rejected', [$solicitud->IdSolicitud, $DetalleSolicitud->IdCliente]) }}"
                        method="post">
                        @csrf
                        <p>Tipo de solicitud: {{ $solicitud->Tipo }}</p>
                        <p>Describa el motivo de rechazo:</p>
                        <textarea name="motivoRechazo" rows="8" cols="60"></textarea>
                        <br>
                        <button>Rechazar solicitud</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="div">
        <p>
            Para realizar alguna acción debe registrarse en el seguimiento al producto ¿
            Desea realizar el seguimiento de este producto?
        </p>
        <form action="{{route('Seguimiento',$solicitud->IdSolicitud)}}" class="form" method="post">
            @csrf
            <div class="form-group">
                <button class="btn btn-outline-success form-control">Realizar seguimiento</button>
            </div>
        </form>
        
        
    </div>
@endif
