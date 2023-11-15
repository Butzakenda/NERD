<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Models\Cliente;
use App\Models\Administrator;
use App\Models\Entrevista;
use App\Models\Notificaciones;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

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
        $solicitudes = Solicitud::OrderBy('Fecha', 'ASC')
            ->with('Cliente')
            ->with('administrador')
            ->get();
        return view('Administrador.solicitudes', compact('solicitudes'));
    }
    public function showSolicitudesDetalles(string $id)
    {

        $DetalleSolicitud = Cliente::with('departamento', 'ciudad', 'solicitudes')->find($id);

        $notificacionesCliente = Notificaciones::where('IdCliente', $id)->first();;
        return view('Administrador.solicitudesDetalle', compact('DetalleSolicitud', 'notificacionesCliente'));
    }
    public function showEntrevistaForm($id)
    {
        $InfoClienteEntrevista = Cliente::where('IdCliente', '=', $id)->get();
        return view('emails.agendarEntrevista', compact('InfoClienteEntrevista'));
    }
    public function agendarReunion($idEntrevista)
    {
        $EntrevistaInfo = Cliente::where('IdCliente', '=', $idEntrevista)->first();
        /* dd($EntrevistaInfo); */
        $InfoClienteEntrevista = [
            'CorreoELectronico' => $EntrevistaInfo->CorreoELectronico, // Reemplaza esto con el correo real del cliente
        ];

        $correoElectronico = isset($InfoClienteEntrevista['CorreoELectronico']) ? urlencode($InfoClienteEntrevista['CorreoELectronico']) : '';
        $tituloEstatico = urlencode('NERD - Entrevista para colaborador');

        $enlace = "https://calendar.google.com/calendar/u/0/r/eventedit?vcon=meet&text={$tituloEstatico}&add={$correoElectronico}";

        // Redirige al enlace
        return redirect()->away($enlace);
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
