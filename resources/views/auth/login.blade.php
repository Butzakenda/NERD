@extends('index')

@section('contenido')
<section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src={{asset('img/fondo.png')}}
            class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 my-5" >
          <form action=" {{route('login')}}" method="POST">
            @csrf
            <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
              <p style="color:white" class="lead fw-normal mb-0 me-3">Ingresar con: </p>
              <button type="button" class="btn btn-primary btn-floating mx-1">
                <i class="fab fa-facebook-f"></i>
              </button>
  
              <button type="button" class="btn btn-primary btn-floating mx-1">
                <i class="fab fa-twitter"></i>
              </button>
  
              <button type="button" class="btn btn-primary btn-floating mx-1">
                <i class="fab fa-linkedin-in"></i>
              </button>

              <button type="button" class="btn btn-primary btn-floating mx-1">
                <i class="fa-brands fa-google"></i>
              </button>
            </div>
  
            <div class="divider d-flex align-items-center my-4">
              <p style="color:white" class="text-center fw-bold mx-3 mb-0">También: </p>
            </div>
  
            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="email" id="email" name="email" class="form-control form-control-lg"
                placeholder="Ingrese su correo electrónico" />
              <label style="color:white" class="form-label" for="form3Example3">Correo Electrónico</label>
            </div>
  
            <!-- Password input -->
            <div class="form-outline mb-3">
              <input type="password" id="password"  name="password" class="form-control form-control-lg"
                placeholder="Enter password" />
              <label style="color:white" class="form-label" for="form3Example4">Contraseña</label>
            </div>
  
            <div class="d-flex justify-content-between align-items-center">
              <!-- Checkbox -->
              <div class="form-check mb-0">
                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                <label style="color:white" class="form-check-label" for="form2Example3">
                  Recuérdame
                </label>
              </div>
              <a style="color:white" href="#!" class="text-body">¿Olvidaste tu contraseña?</a>
            </div>
  
            <div class="text-center text-lg-start mt-4 pt-2">
              <button type="submit" class="btn btn-primary btn-lg"
                style="padding-left: 2.5rem; padding-right: 2.5rem; color: white;">Ingresar</button>
              <p class="small fw-bold mt-2 pt-1 mb-0" style="color:white">¿No estás registrado? <a href=""
                  class="link-danger">Registrarse</a></p>
            </div>
  
          </form>
        </div>
      </div>
    </div>
    
  </section>
@endsection
