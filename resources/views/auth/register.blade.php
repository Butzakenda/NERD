@extends('index')

@section('contenido')
<!-- Section: Design Block -->
<section class="">
    <!-- Jumbotron -->
    <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: black">
      <div class="container">
        <div class="row gx-lg-5 align-items-center">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <h1 class="my-5 display-3 fw-bold ls-tight" style="color:hsl(217, 10%, 50.8%) ">
              Uniendo Talento, <br />
              <span class="text-primary">creando oportunidades</span>
            </h1>
            <p style="color: white">
              Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Eveniet, itaque accusantium odio, soluta, corrupti aliquam
              quibusdam tempora at cupiditate quis eum maiores libero
              veritatis? Dicta facilis sint aliquid ipsum atque?
            </p>
          </div>
  
          <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="card">
              <div class="card-body py-5 px-md-5">
                    <div>
                        <h2>
                            Bienvenido,
                        </h2>
                        <p>Por favor, completa los siguientes campos</p>
                        <p>Campos marcados con * son obligatorios</p>
                    </div>
                  <!-- 2 column grid layout with text inputs for the first and last names -->
                  <form action="{{route('register')}}" method="post">
                    @csrf
                    <div class="row">
                      <div class="col-md-6 mb-4">
                        <div class="form-outline">
                          <input type="text" id="form3Example1" name="NombresClienteInput" class="form-control @error('NombresClienteInput') is-invalid @enderror" value="{{ old('NombresClienteInput') }}"/>
                          <label class="form-label" for="">Nombres *</label>
                          @error('NombresClienteInput')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6 mb-4">
                        <div class="form-outline">
                          <input type="text" id="form3Example2" name="ApellidosClienteInput" class="form-control @error('ApellidosClienteInput') is-invalid @enderror" value="{{ old('ApellidosClienteInput') }}"/>
                          <label class="form-label" for="form3Example2">Apellidos *</label>
                          @error('ApellidosClienteInput')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                          @enderror
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 mb-4">
                        <div class="form-outline">
                          <label class="form-label" for="form3Example1">Tipo de documento *</label>
                          <div class="form-check">
                              <input class="form-check-input" name="tipoDocumentoClienteInput" type="radio" name="tipoDocumento" value="Cédula de Ciudadanía">
                              <label class="form-check-label" for="">Cédula de Ciudadanía</label>
                          </div>
                          <div class="form-check">
                              <input type="radio" class="form-check-input" name="tipoDocumentoClienteInput" value="Cédula de Extranjería">
                              <label class="form-check-label" for="">Cédula de Extranjería</label>
                          </div>
                          @error('tipoDocumentoClienteInput') <!-- Aquí se debe mostrar el mensaje de error -->
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                          @enderror
                      </div>
                      </div>
                      <div class="col-md-6 mb-4">
                        <div class="form-outline">
                          <input type="text" id="form3Example2" name="numDocumentoClienteInput" class="form-control @error('numDocumentoClienteInput') is-invalid @enderror" value="{{ old('numDocumentoClienteInput') }}"/>
                          <label class="form-label" for="form3Example2">Número de documento *</label>
                          @error('numDocumentoClienteInput')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                          @enderror
                        </div>
                      </div>
                    </div>
                    <div class="form-outline mb-4">
                      <input type="date" id="" class="form-control FechaNacimientoClienteInput @error('FechaNacimientoClienteInput') is-invalid @enderror" name="FechaNacimientoClienteInput" value="{{ old('FechaNacimientoClienteInput') }}"/>
                      <label class="form-label" for="form3Example4">Fecha de nacimiento *</label>
                          @error('FechaNacimientoClienteInput')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                          @enderror
                    </div>
                    <div class="row">
                      <div class="col-md-6 mb-4">
                        <div class="form-outline">
                          {{-- name="DepartamentoClienteInput" class="form-control @error('DepartamentoClienteInput') is-invalid @enderror" value="{{ old('DepartamentoClienteInput') }}" --}}
                          <label class="form-label" for="">Departamento de Residencia *</label>
                          <select name="departamentoClienteInput" id="departamentoClienteInput" class="@error('departamentoClienteInput') is-invalid @enderror" value="{{ old('departamentoClienteInput') }}">
                                  <option value="">Seleccione un departamento</option>
                              @foreach($departamentos as $departamento)
                                  <option value=" {{$departamento->IdDepartamento}} "> {{$departamento->Nombre}} </option>
                              @endforeach
                          </select>
                          @error('departamentoClienteInput')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                          @enderror
                        </div>
                      </div>
                      
                      <div class=" mb-4">
                        <div class="form-outline">
                          {{-- name="DepartamentoClienteInput" class="form-control @error('DepartamentoClienteInput') is-invalid @enderror" value="{{ old('DepartamentoClienteInput') }}" --}}
                          <label class="form-label" for="">Ciudad de Residencia*</label>
                          <select name="ciudadClienteInput" id="ciudadClienteInput" class="@error('ciudadClienteInput') is-invalid @enderror" value="{{ old('ciudadClienteInput') }}">
                                  <option value="">Seleccione una ciudad</option>
                          </select>
                          @error('ciudadClienteInput')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                          @enderror
                        </div>
                      </div>
                      
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                      <input type="email" id="form3Example3" name="CorreoElectronicoClienteInput" class="form-control @error('CorreoElectronicoClienteInput') is-invalid @enderror" value="{{ old('CorreoElectronicoClienteInput') }}"/>
                      <label class="form-label" for="form3Example3">Correo Electrónico *</label>
                          @error('CorreoElectronicoClienteInput')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                          @enderror
                    </div>
                    <div class="form-outline mb-4">
                      <input type="email" id="form3Example3" name="telefonoClienteInput" class="form-control" />
                      <label class="form-label" for="form3Example3">Teléfono</label>
                          @error('telefonoClienteInput')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                          @enderror
                    </div>
                    <!-- Password input -->
                    <div class="form-outline mb-4">
                      <input type="password" id="form3Example4" name="ContrasenaClienteInput" class="form-control @error('ContrasenaClienteInput') is-invalid @enderror" value="{{ old('ContrasenaClienteInput') }}"/>
                      <label class="form-label" for="form3Example4">Contraseña *</label>
                          @error('ContrasenaClienteInput')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                          @enderror
                    </div>
                    <div class="form-outline mb-4">
                      <input type="password" id="form3Example4" name="ConfirmarContrasenaClienteInput" class="form-control @error('ConfirmarContrasenaClienteInput') is-invalid @enderror" value="{{ old('ConfirmarContrasenaClienteInput') }}"/>
                      <label class="form-label" for="form3Example4">Confirmar Contraseña *</label>
                        @error('ConfirmarContrasenaClienteInput')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                  
                  
  
                  <!-- Checkbox -->
                  <div class="form-check d-flex justify-content-center mb-4">
                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example33" checked />
                    <label class="form-check-label" for="form2Example33">
                      ¡Subscríbete a nuestro boletín semanal y mantente al día!
                    </label>
                  </div>
  
                  <!-- Submit button -->
                  <button type="submit" class="btn btn-primary btn-block mb-4">
                    Registrarse
                  </button>
                </form>
                  <!-- Register buttons -->
                  <div class="text-center">
                    <p>or sign up with:</p>
                    <button type="button" class="btn btn-link btn-floating mx-1">
                      <i class="fab fa-facebook-f"></i>
                    </button>
  
                    <button type="button" class="btn btn-link btn-floating mx-1">
                      <i class="fab fa-google"></i>
                    </button>
  
                    <button type="button" class="btn btn-link btn-floating mx-1">
                      <i class="fab fa-twitter"></i>
                    </button>
  
                    <button type="button" class="btn btn-link btn-floating mx-1">
                      <i class="fab fa-github"></i>
                    </button>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Jumbotron -->
  </section>
  <!-- Section: Design Block -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src=" {{asset('js/ciudades.js')}} "></script>
  <script>
    var buscarCiudadesRoute = '{{ route("buscarciudades", ":id") }}';
  </script>
@endsection
