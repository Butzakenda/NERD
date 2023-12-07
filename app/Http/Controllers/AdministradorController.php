<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Models\Cliente;
use App\Models\Administrator;
use App\Models\Colaborador;
use App\Models\Entrevista;
use App\Models\Notificaciones;
use App\Models\Contrato;
use App\Models\SeguimientoProductos;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\PQR;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\CredencialesNuevoColaborador;
use Illuminate\Support\Facades\File;

class AdministradorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function guardarPqr(Request $request)
    {
        try {
            $cliente = null;
            $colaborador = null;
    
            $user = Auth::User();
    
            $userTipo = $user->tipo;
    
            if ($userTipo == 'Cliente') {
                $cliente = $user->cliente;
                $pqr = PQR::create([
                    'IdCliente' => $cliente->IdCliente,
                    'Tipo' => $request['tipoPQR'],
                    'Calidad' =>  $userTipo,
                    'Descripcion' => $request['descripcionPQR']
                ]);
            } else {
                $colaborador = $user->colaborador;
                $pqr = PQR::create([
                    'IdColaborador' => $colaborador->IdColaborador,
                    'Tipo' => $request['tipoPQR'],
                    'Calidad' =>  $userTipo,
                    'Descripcion' => $request['descripcionPQR']
                ]);
            }
            DB::beginTransaction();
            DB::commit();
            session()->forget('success_message');
            session()->flash('success_message', '¡Se ha enviado el PQR!');
            session()->put('flash_lifetime', now()->addSeconds(5));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();

            session()->forget('error_message');
            session()->flash('error_message', 'Se produjo un error al procesar la solicitud.');
            session()->put('flash_lifetime', now()->addSeconds(5));
            return redirect()->back();
        }
    }
    public function showSolicitudes()
    {
        //
        $solicitudes = Solicitud::OrderBy('IdSolicitud', 'desc')
            ->with('Cliente')
            ->with('administrador')
            ->paginate(8);
        return view('Administrador.solicitudes', compact('solicitudes'));
    }
    public function showSolicitudesDetalles(string $id, $idsolicitud)
    {
        // Obtener el cliente con la solicitud específica cargada
        $DetalleSolicitud = Cliente::with(['departamento', 'ciudad', 'solicitudes' => function ($query) use ($idsolicitud) {
            $query->where('IdSolicitud', $idsolicitud);
        }])->find($id);
        //Obtener los datos de la solicitud
        $Solicitud = Solicitud::where('IdSolicitud', $idsolicitud)->first();

        //Actualizar $SeguimientoSolicitud para que lleve los datos de SeguimientoProductos
        $SeguimientoSolicitud = SeguimientoProductos::where('IdSeguimientoProductos', $Solicitud->IdSeguimientoProductos)
            ->with('contratos')
            ->get();
        
        $hojaVidaPath = asset('pdfs/Documents-' . $id . '/contrato/' . $id .'_hoja_vida.pdf');
        $seguroMedicoPath = asset('pdfs/Documents-' . $id . '/contrato/' . $id . '_seguro_medico.pdf');
        $documentoIdentificacionPath = asset('pdfs/Documents-' . $id . '/contrato/' . $id . '_copia_cedula.pdf');

        // Obtener las notificaciones del cliente
        $notificacionesCliente = Notificaciones::where('IdCliente', $id)->first();

        return view('Administrador.solicitudesDetalle', compact(
            'DetalleSolicitud',
            'notificacionesCliente',
            'SeguimientoSolicitud',
            'hojaVidaPath',
            'seguroMedicoPath',
            'documentoIdentificacionPath'
        ));
    }

    public function showEntrevistaForm($id)
    {
        $InfoClienteEntrevista = Cliente::where('IdCliente', '=', $id)->get();
        return view('emails.agendarEntrevista', compact('InfoClienteEntrevista'));
    }
    public function agendarReunion($idsolicitud, $idEntrevista)
    {

        try {
            $EntrevistaInfo = Cliente::where('IdCliente', '=', $idEntrevista)->first();
            /* dd($EntrevistaInfo); */
            $solicitud = Solicitud::where('IdSolicitud', $idsolicitud)->first();
            /* dd($solicitud); */
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
    public function RealizarContrato(string $idseguimiento, $idcliente)
    {
        try {
            //Hallar al cliente
            $cliente = Cliente::where('IdCliente', $idcliente)->first();
            //Hallar el seguimiento asocioado
            $seguimiento = SeguimientoProductos::where('IdSeguimientoProductos', $idseguimiento)->first();
    
            $solicitud = Solicitud::where('IdSolicitud', $seguimiento->IdSolicitud)->first();
    
            $contrato = Contrato::where('IdSeguimientoProductos', $seguimiento->IdSeguimientoProductos)->first();
    
            // Definir el directorio base
            $pdfBaseDirectory = public_path('pdfs');
            // Obtener el ID del cliente
            $idCliente = $cliente->IdCliente;
            // Define el nombre de la carpeta del cliente
            $clienteFolder = 'Documents-' . $idCliente;
            // Verifica si la carpeta del cliente existe, si no, créala
            $clienteDirectory = $pdfBaseDirectory . '/' . $clienteFolder;
            if (!File::isDirectory($clienteDirectory)) {
                File::makeDirectory($clienteDirectory, 0755, true);
            }
            // Verifica si la carpeta contrato existe dentro de $clienteDirectory, si no créala
            $contratoDirectory = $clienteDirectory . '/contrato';
            if (!File::isDirectory($contratoDirectory)) {
                File::makeDirectory($contratoDirectory, 0755, true);
            }
    
            $contratoPDF = PDF::loadView('administrador.pdfs.contrato', ['cliente' => $cliente]);
            $contratoPDFPath = $contratoDirectory . '/' . $idCliente . '_NERD_contrato.pdf';
            $contratoPDF->save($contratoPDFPath);
    
    
    
            //Crear el colaborador
            $colaborador = Colaborador::create([
                'IdDepartamento' => $cliente->IdDepartamento,
                'IdCiudad' => $cliente->IdCiudad,
                'Documento' => $cliente->Documento,
                'Nombres' => $cliente->Nombres,
                'Apellidos' => $cliente->Apellidos,
                'Telefono' => $cliente->Telefono,
                'FechaNacimiento' => $cliente->FechaNacimiento,
            ]);
            //Actualzar el contrato
            $contrato->update([
                'Contrato' => $contratoPDFPath,
                'IdColaborador' => $colaborador->IdColaborador,
            ]);
    
            //Actualizar el seguimiento
            $seguimiento->update([
                'IdColaborador' => $colaborador->IdColaborador,
            ]);
            $solicitud->update([
                'Estado' => 'Contratado'
            ]);
    
            DB::beginTransaction();
            DB::commit();
            $correo = new CredencialesNuevoColaborador($colaborador);
            $correo->with([
                'nombre' => $colaborador->Nombres,
                'correo' => $colaborador->CorreoELectronico,
                'idColaborador' => $colaborador->IdColaborador,
            ]);
            Mail::to($cliente->CorreoELectronico)->send($correo);
            session()->forget('success_message');
            session()->flash('success_message', '¡Se ha creado el colaborador!');
            session()->put('flash_lifetime', now()->addSeconds(5));
            return redirect()->back();
        } catch (\Exception $e) {
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
