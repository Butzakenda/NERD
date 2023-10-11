<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Models\Cliente;
use App\Models\Administrator;
use App\Models\Entrevista;
class AdministradorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function showSolicitudes()
    {
        //
        $solicitudes = Solicitud::OrderBy('Fecha','ASC')
        ->with('Cliente')
        ->with('administrador')
        ->get();
        return view ('Administrador.solicitudes', compact('solicitudes'));
    }
    public function showSolicitudesDetalles(string $id)
    {
        $DetalleSolicitud = Cliente::with('departamento', 'ciudad', 'solicitudes')->find($id);
        $solcitudCliente = Solicitud::where('IdCliente','=',$id);
        
        return view ('Administrador.solicitudesDetalle',compact('DetalleSolicitud'));
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