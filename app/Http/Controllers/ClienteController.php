<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;

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
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
