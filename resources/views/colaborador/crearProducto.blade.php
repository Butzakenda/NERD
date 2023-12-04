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
    <div class="container-fluid">
        <h1 class="texto">
            Crear nuevo producto:
        </h1>
        <form action=" {{ route('productos.crear', Auth::User()->id) }} " method="post" class="form"
            enctype="multipart/form-data">
            @csrf
            <p class="texto">
                Rellene los siguientes campos:
            </p>
            <div class="row">
                <label class="form-label texto">Departamento de Residencia
                    *</label>
                <select name="departamentoProductoInput" id="departamentoProductoInput"
                    class="@error('departamentoProductoInput') is-invalid @enderror"
                    value="{{ old('departamentoProductoInput') }}">
                    <option value="">Seleccione un departamento:</option>
                    @foreach ($departamentos as $departamento)
                        <option value=" {{ $departamento->IdDepartamento }} ">
                            {{ $departamento->Nombre }} </option>
                    @endforeach
                </select>
                @error('departamentoProductoInput')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="row">
                <label class="form-label texto">Ciudad de Residencia*</label>
                <select name="ciudadProductoInput" id="ciudadProductoInput"
                    class="@error('ciudadProductoInput') is-invalid @enderror" value="{{ old('ciudadProductoInput') }}">
                    <option value="">Seleccione una ciudad</option>
                </select>
                @error('ciudadProductoInput')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="row">
                <label class="form-label texto">Categoría*</label>
                <select name="categoriaProductoInput" id="categoriaProductoInput"
                    class="@error('categoriaProductoInput') is-invalid @enderror"
                    value="{{ old('categoriaProductoInput') }}">
                    <option value="">Seleccione la categoría</option>
                    @foreach ($categoria as $categoria)
                        <option value=" {{ $categoria->IdCategoria }} ">
                            {{ $categoria->Nombre }} </option>
                    @endforeach
                </select>
                @error('categoriaProductoInput')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="row">
                <label class="form-label texto">Nombre*</label>
                <input name="nombreProductoInput" type="text">
            </div>
            <div class="row">
                <label class="form-label texto">Descripción*</label>
                <textarea name="descripcionProductoInput" id="" cols="30" rows="5"></textarea>
            </div>
            <div class="row">
                <label class="form-label texto">Precio*</label>
                <input name="precioProductoInput" type="number">
            </div>
            <div class="row">
                <div class="col">

                    <label class="form-label texto">Foto*</label>

                    <input name="fotoProductoInput" id="fotoProductoInput" class="form-control" type="file">
                </div>
                <div class="col-6">
                    <br>
                    <button class="btn btn-primary submit">Crear Producto</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src=" {{ asset('js/ciudadesProductos.js') }} "></script>
    <script>
        var buscarCiudadesRoute = '{{ route('buscarciudades', ':id') }}';
    </script>
@endsection
