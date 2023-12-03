<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Contrato</title>
  <!-- Enlace a Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Tu CSS personalizado puede ir aquí -->
  <style>
    /* Agrega tus estilos personalizados aquí */
  </style>
</head>
<body>

<div class="container mt-5">
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <h1 class="text-center">Contrato de Servicios</h1>
      <p class="text-justify">Este contrato se celebra entre el señor(a) {{$cliente->Nombres . " " . $cliente->Apellidos}} 
        identificado con {{$cliente->Documento}} y NERD Enterprise Business.</p>

      <!-- Agrega más cláusulas y contenido según tus necesidades -->

      <p class="text-right mt-5">Fecha: {{now()}} </p>
      <p class="text-right">Firma del Cliente: _______________________</p>
      <p class="text-right">Firma de la Empresa: ______________________</p>
    </div>
  </div>
</div>

<!-- Enlace a Bootstrap JS y Popper.js (requeridos para ciertas funciones de Bootstrap) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
