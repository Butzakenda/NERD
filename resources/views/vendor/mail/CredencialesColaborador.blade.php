@component('mail::message')
    # ¡Bienvenido a NERD!

    Te damos la bienvenida a NERD colaborador. Pero antes de empezar tienes que crear tu usuario, utiliza el siguiente
    enlace

    Por favor, haz clic en el siguiente enlace para establecer tu correo y contraseña personalizados y convertirte en un
    colaborador:

    @component('mail::button', [
        'url' => route('mostrar-formulario-registro', ['IdColaborador' => $colaborador->IdColaborador]),
    ])
        Establecer credenciales
    @endcomponent



    Por favor, guarda esta información de manera segura.

    Gracias,
    NERD Team
@endcomponent
