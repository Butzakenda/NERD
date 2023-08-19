<?php

namespace App\Http\Controllers;
use App\Models\Departamentos;
use App\Models\Ciudades;
use Illuminate\Http\Request;

class DepartamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $departamentos = departamentos::OrderBy('IdDepartamento','ASC')->with('Ciudades')->get();
        return view('auth.register', compact('departamentos'));
    }
    public function consultarCiudades($id){
        try {
            $ciudades = Ciudades::where('IdDepartamento', $id)->orderBy('Nombre', 'ASC')->get();
            return $ciudades;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
