<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use App\Models\Departamentos;
use App\Models\Cliente;
use App\Models\Factura;
use App\Http\Controllers\Colaborador;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $productos = Producto::orderBy('IdColaborador', 'desc')
        ->with('colaborador')
        ->paginate(5);
        /* dd($productos); */
        $productoChunks = $productos->chunk(2);
         /* dd($productoChunks); */
        return view('producto.index', compact('productos','productoChunks'));
        //return view('producto.index');
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
