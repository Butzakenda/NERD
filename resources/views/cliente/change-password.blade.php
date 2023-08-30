{{-- Esta vista es la que se muestra cuando el usuario se ha autenticado y selecciona la opción 
     de cambiar contraseña en el área de trabajo 
     El formulario apunta al método updatePassword en el controlador ClienteController
     --}}
@extends('session')

@section('contenidoAT')
    <div class="container">
        <h2>Cambiar Contraseña</h2>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-12 mb-2">
                <form method="POST" action="{{ route('cliente.updatePassword') }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Contraseña Actual:</label>
                        <input class="form-control" type="password" name="current_password">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nueva Contraseña:</label>
                        <input class="form-control" type="password" name="new_password">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Confirmar Nueva Contraseña:</label>
                        <input class="form-control" type="password" name="new_password_confirmation">
                    </div>
                    <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
                </form>
            </div>
        </div>
    </div>
@endsection
