<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\SolicitarAlianza;
use Illuminate\Support\Facades\Mail;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cliente = Cliente::where('user_id', auth()->id())->first();
        /* dd($cliente); */
        return view('session');
    }
    public function solicitarAlianzaForm()
    {
        $clienteSA = Auth::user()->cliente;
        $descripcion = '';
        /* dd($clienteSA); */
        return view('session', ['mostrar_formulario' => true],  compact('clienteSA','descripcion'));
    }
    
    
    public function enviarSolicitudAlianza(Request $request)
    {
        $clienteSA = Auth::user()->cliente; // Acceder a la relación cliente
        $descripcion = $request->input('descripcion');
    
        Mail::to('butzakenda@gmail.com')->send(new SolicitarAlianza($clienteSA, $descripcion));
        return back();
    }

    /**
     * Show the form for creating a new resource.
     */
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($user_id)
    {
        $user = User::find($user_id);
        $cliente = $user->cliente;
        /* dd($cliente); */
        return view('cliente.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los campos proporcionados por el usuario
        $cliente = Cliente::findOrFail($id);

        // Validar y actualizar cada campo uno por uno si no es nulo
        if (!is_null($request->input('ActualizarNombreCliente'))) {
            $cliente->update(['Nombres' => $request->input('ActualizarNombreCliente')]);
        }

        if (!is_null($request->input('ActualizarApellidosCliente'))) {
            $cliente->update(['Apellidos' => $request->input('ActualizarApellidosCliente')]);
        }

        if (!is_null($request->input('ActualizarTelefonoCliente'))) {
            $cliente->update(['Telefono' => $request->input('ActualizarTelefonoCliente')]);
        }
        if (!is_null($request->input('ActualizarCorreoCliente'))) {
            $cliente->update(['CorreoELectronico' => $request->input('ActualizarCorreoCliente')]);
        }
        if (!is_null($request->input('ActualizarDocumentoCliente'))) {
            $cliente->update(['Documento' => $request->input('ActualizarDocumentoCliente')]);
        }
        if (!is_null($request->input('ActualizarFechaNaciCliente'))) {
            $cliente->update(['FechaNacimiento' => $request->input('ActualizarFechaNaciCliente')]);
        }
        /* dd($cliente); */
        return redirect()->back();
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (Hash::check($request->current_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);

            return redirect()->route('cliente.changePasswordForm')->with('success', 'Contraseña actualizada correctamente.');
        } else {
            return redirect()->route('cliente.changePasswordForm')->with('error', 'La contraseña actual no coincide.');
        }
    }
    /**
     * Remove the specified resource from storage.
     */

    public function showChangePasswordForm()
    {
        //
        return view('cliente.change-password');
    }
    public function destroy(string $id)
    {
        //
    }
}
