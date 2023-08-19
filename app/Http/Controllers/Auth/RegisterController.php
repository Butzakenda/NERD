<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Cliente;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // Reglas de validación aquí
            'NombresClienteInput' => 'required|string',
            'ApellidosClienteInput' => 'required|string',
            'tipoDocumentoClienteInput' => 'required|string',
            'numDocumentoClienteInput' => 'required|unique:clientes,Documento|string',
            'CorreoElectronicoClienteInput' => 'required|email|unique:users,email|string',
            'telefonoClienteInput' => 'nullable|numeric',
            'FechaNacimientoClienteInput' => 'required|date',  
            'ContrasenaClienteInput' => 'required|string|min:8|',
            'departamentoClienteInput' => 'required',
            'ciudadClienteInput' => 'required',
            'ConfirmarContrasenaClienteInput' => 'required|min:8|same:ContrasenaClienteInput',
        ], [
            // Mensajes de error aquí
            'NombresClienteInput.required' => 'El campo Nombres es obligatorio.',
            'ApellidosClienteInput.required' => 'El campo Apellidos es obligatorio.',
            'tipoDocumentoClienteInput.required' => 'El campo Tipo de documento es obligatorio.',
            /* 'FechaNacimientoClienteInput.required' => 'El campo Fecha de Nacimiento es obligatorio.', */
            'tipoDocumentoClienteInput.unique' => 'Este número de documento de identidad ya ha sido registrado.',
            'numDocumentoClienteInput.required' => 'El campo Documento es obligatorio.',
            'departamentoClienteInput.required' => 'Debe elegir un departamento',
            'ciudadClienteInput.required' => 'Debe elegir una ciudad',
            //Correo Electrónico
            'CorreoElectronicoClienteInput.required' => 'El campo Correo Electrónico es obligatorio.',
            'CorreoElectronicoClienteInput.email' => 'El campo Correo Electrónico debe ser una dirección de correo electrónico válida.',
            'CorreoElectronicoClienteInput.unique' => 'Este Correo Electrónico ya ha sido registrado.',
            //Contraseña---------------------------------------------------------------------------------------
            'ContrasenaClienteInput.required' => 'El campo de Contraseña es obligatorio.',
            'ContrasenaClienteInput.min' => 'La contraseña debe tener al menos :min caracteres.',
            'ContrasenaClienteInput.confirmed' => 'Las contraseñas no coinciden.',
            'ConfirmarContrasenaClienteInput.required' => 'El campo de Confirmar Contraseña es obligatorio.',
            'ConfirmarContrasenaClienteInput.min' => 'La confirmación de contraseña debe tener al menos :min caracteres.'
        ]);
    }
    

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Cliente
     */
    protected function create(Request $request)
    {   
        
        /* dd($request); */
        App::setLocale('es');
        $validator = $this->validator($request->all());
        
        /* dd($validator->errors()); */
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Crear el cliente y el usuario
        Cliente::create([
            // Campos de cliente aquí
                'IdDepartamento' => $request ['departamentoClienteInput'],
                'IdCiudad' => $request ['ciudadClienteInput'],
                'Documento' => $request ['numDocumentoClienteInput'],
                'tipoDocumento' => $request ['tipoDocumentoClienteInput'],
                'Nombres' => $request ['NombresClienteInput'],
                'Apellidos' => $request ['ApellidosClienteInput'],
                'CorreoELectronico' => $request ['CorreoElectronicoClienteInput'],
                'telefono' => $request ['telefonoClienteInput'],
                'FechaNacimiento' => $request ['FechaNacimientoClienteInput']
        ]);
        User::create([
            // Campos de usuario aquí
                'name' => $request['NombresClienteInput'],
                'email' => $request['CorreoElectronicoClienteInput'],
                'password' => Hash::make($request['ContrasenaClienteInput']),
        ]);

        return view('auth.login'); // O redirige a la página que desees
    }
}
    