<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ColaboradorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function mostrarFormularioRegistro($idColaborador)
    {


        $Colaborador = Colaborador::where('IdColaborador', $idColaborador)->first();

        return view('colaborador.registro', compact('Colaborador'));
    }

    public function procesarFormularioRegistro(Request $request, $idColaborador)
    {
        try {
            $Colaborador = Colaborador::where('IdColaborador', $idColaborador)->first();

            $user = User::create([
                'name' => $Colaborador->Nombres,
                'email' => $request['correoColaborador'],
                'tipo' => 'Colaborador',
                'password' => Hash::make($request['passwordColaborador']),
            ]);
            $Colaborador->update([
                'user_id' => $user->id
            ]);
            return view('inicio')->with('success', 'Colaborador registrado exitosamente.');
        } catch (\Exception $e) {
            return view('inicio')->with('error', 'Ha ocurrido un problema');
        }
    }
    public function index()
    {
        //
    }
    public function showCrearColaboradorForm()
    {
        return view('administrador.crear-colaborador');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
