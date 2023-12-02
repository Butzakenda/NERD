<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Models\Cliente;
use App\Models\Administrator;
use App\Models\Entrevista;
use App\Models\Notificaciones;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

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
    public function showSolicitudesDetalles(string $id, $idsolicitud)
    {
        // Obtener el cliente con la solicitud específica cargada
        $DetalleSolicitud = Cliente::with(['departamento', 'ciudad', 'solicitudes' => function ($query) use ($idsolicitud) {
            $query->where('IdSolicitud', $idsolicitud);
        }])->find($id);

        // Obtener las notificaciones del cliente
        $notificacionesCliente = Notificaciones::where('IdCliente', $id)->first();

        return view('Administrador.solicitudesDetalle', compact('DetalleSolicitud', 'notificacionesCliente'));
    }

    public function showEntrevistaForm($id)
    {
        $InfoClienteEntrevista = Cliente::where('IdCliente', '=', $id)->get();
        return view('emails.agendarEntrevista', compact('InfoClienteEntrevista'));
    }
    public function agendarReunion($idEntrevista)
    {

        try {
            $EntrevistaInfo = Cliente::where('IdCliente', '=', $idEntrevista)->first();

            $solicitud = Solicitud::where('IdCliente', $idEntrevista)->first();
            /* dd($EntrevistaInfo); */
            $solicitud->update([
                'Estado' => 'Entrevista'
            ]);
            $InfoClienteEntrevista = [
                'CorreoELectronico' => $EntrevistaInfo->CorreoELectronico,
            ];
            DB::beginTransaction();
            DB::commit();
            $correoElectronico = isset($InfoClienteEntrevista['CorreoELectronico']) ? urlencode($InfoClienteEntrevista['CorreoELectronico']) : '';
            $tituloEstatico = urlencode('NERD - Entrevista para colaborador');
            $enlace = "https://calendar.google.com/calendar/u/0/r/eventedit?vcon=meet&text={$tituloEstatico}&add={$correoElectronico}";
            // Redirige al enlace
            session()->forget('success_message');
            session()->flash('success_message', '¡Se ha agendado la entrevista!');
            session()->put('flash_lifetime', now()->addSeconds(5));
            return redirect()->away($enlace)->withHeaders(['target' => '_blank']);
        } catch (\Exception $e) {
            // En caso de error, maneja la excepción y revierte la transacción
            DB::rollBack();

            session()->forget('error_message');
            session()->flash('error_message', 'Se produjo un error al procesar la solicitud.');
            session()->put('flash_lifetime', now()->addSeconds(5));
            return redirect()->back();
        }
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
