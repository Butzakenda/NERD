@extends('index') 

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registro de Colaborador') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('procesar-formulario-registro', $Colaborador->IdColaborador) }}">
                        @csrf
                        <p>
                            Aquí debes digitar tu correo y contraseña, estas serán tus credenciales de acceso a la plataforma
                            como Colaborador. No puedes utilizar el mismo correo de tu cuenta de cliente, si quieres usar ese de allá, tendrás que iniciar
                            sesión con tu usuario cliente, cambiar el correo y realizar este procedimiento nuevamente.
                        </p>
                        <h4>Credenciales para colaborador:</h4>
                        <input type="hidden" name="id_usuario_cliente" value="{{ $Colaborador->IdColaborador }}">

                        <div class="form-group row">
                            <label for="correo" class="col-md-4 col-form-label text-md-right form-label">{{ __('Correo Electrónico') }}</label>

                            <div class="col-md-6">
                                <input id="correoColaborador" type="email" class="form-control" name="correoColaborador" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right form-label">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="passwordColaborador" type="password" class="form-control" name="passwordColaborador" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrar Colaborador') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
