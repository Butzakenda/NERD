<!-- Modal Compra-->
<div class="modal fade" id="compraProducto{{ $index }}" data-bs-keyboard="false" tabindex="-1"
aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header" style="background: hsl(230, 30%, 15%)">
            <h5 class="modal-title texto" id="staticBackdropLabel">{{ $producto->Nombre }}</h5>
            <button type="button" class="btn-close btn-close-white" aria-label="Close"
                data-bs-dismiss="modal"></button>
        </div>
        <form action="{{route('factura', $producto->IdProducto)}}" method="post">
            @csrf
            <div class="modal-body" style="background: hsl(230, 30%, 40%)">
                <h6 class="mb-4 texto">
                    <strong>Colaborador:</strong>
                    {{ $producto->colaborador->Nombres . ' ' . $producto->colaborador->Apellidos }}
                </h6>
                <h4 class="mb-3 texto">
                    <strong>Detalles de la compra:</strong>
                </h4>
                @if (!is_null($producto->fotoPathConNombre))
                    <img src="{{ asset($producto->fotoPathConNombre) }}"
                        class="card-img-top card-img" alt="User Image"
                        style="object-fit: contain; height: 100px;">
                @else
                    <img src="{{ asset('img/man.png') }}" class="card-img-top card-img"
                        alt="User Image" style="object-fit: contain; height: 100px;">
                @endif
                <p class="text-light texto">
                    <strong>Descripción del producto:</strong>
                </p>
                <p class="text-light mb-4">
                    {{ $producto->Descripcion }}
                </p>
                <p class="text-light mb-4">
                    <strong>Precio:</strong> {{ $producto->Precio }}
                </p>
                <h5 class="mb-3 text-light">
                    <strong>Método de pago:</strong>
                </h5>
                
                <div class="form-check text-light mb-3">
                    <input class="form-check-input" type="radio" name="metodoPago"
                        id="flexRadioDefault1"  value="Débito">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Débito
                    </label>
                </div>
                <div class="form-check mb-4 text-light">
                    <input class="form-check-input" type="radio" name="metodoPago"
                        id="flexRadioDefault2"  value="Crédito">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Crédito
                    </label>
                </div>
            </div>
            <div class="modal-footer" style="background: hsl(230, 30%, 15%)">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Realizar compra</button>
            </div>
        </form>

    </div>
</div>
</div>