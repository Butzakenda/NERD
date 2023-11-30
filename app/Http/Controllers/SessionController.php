<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Producto;
use App\Models\User;
use App\Models\Notificaciones;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $productos = Producto::orderBy('IdColaborador', 'desc')->with('colaborador')->get();
        $productoChunks = $productos->chunk(4);

        /* dd($productos); */
        return view('inicio', compact('productos', 'productoChunks'));
    }
    public function RegistroActividad(string $id)
    {
        try {
            //code...
            $user = User::find($id);
            $cliente = $user->cliente;
            $notificaciones = Notificaciones::where('IdCliente', $cliente->IdCliente)
            ->orderBy('IdNotificacion', 'desc')
            ->get();

            //dd($notificaciones);
            return view('cliente.registroActividad', compact('notificaciones'));
        } catch (\Exception $e) {
            //throw $th;
            session()->forget('error_message');
            session()->flash('error_message', 'Algo ha salido mal...');
            session()->put('flash_lifetime', now()->addSeconds(5));
            // Regresa con la variable de sesión
            return redirect()->back();
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
