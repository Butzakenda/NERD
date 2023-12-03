<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Producto;
use App\Models\User;
use App\Models\Notificaciones;
use App\Models\Colaborador;
use App\Models\Contrato;
use App\Models\SeguimientoProductos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
            return view('cliente.RegistroActividad.registroActividad', compact('notificaciones'));
        } catch (\Exception $e) {
            //throw $th;
            session()->forget('error_message');
            session()->flash('error_message', 'Algo ha salido mal...');
            session()->put('flash_lifetime', now()->addSeconds(5));
            // Regresa con la variable de sesión
            return redirect()->back();
        }
    }
    public function RegistroActividadDetalles()
    {

        return view('cliente.RegistroActividad.Documentacion');
    }
    public function DocumentosContrato(Request $request, string $id)
    {
        try {
            //Encontrar al usuario del cliente
            $user = User::find($id);
            //Encontrar al cliente de ese usuario
            $cliente = $user->cliente;
            //Definir una raíz para los proyectos
            $pdfBaseDirectory = public_path('pdfs');
            //Hallar el Id del cliente
            $idCliente = $cliente->IdCliente;
            //Definir la carpeta de los documentos con el id del cliente
            $clienteFolder = 'Documents-' . $idCliente;
            //Definir un carpeta para el cliente dentro de Public
            $clienteDirectory = $pdfBaseDirectory . '/' . $clienteFolder;
            //Crear la carpeta del cliente en caso de que no exista
            if (!File::isDirectory($clienteDirectory)) {
                File::makeDirectory($clienteDirectory, 0755, true);
            }
            //Crear la carpeta contrato dentro del folder del cliente, si no existe
            $contratoDirectory = $clienteDirectory . '/contrato';

            if (!File::isDirectory($contratoDirectory)) {
                File::makeDirectory($contratoDirectory, 0755, true);
            }
            // dd($contratoDirectory);
            // Nombres específicos para los archivos
            $hojaVidaFileName =  $idCliente . '_hoja_vida.pdf';
            $seguroMedicoFileName = $idCliente . '_seguro_medico.pdf';
            $documentoIdentificacionFileName = $idCliente . '_copia_cedula.pdf';

            // Guardar los archivos con los nombres específicos
            $hojaVidaFile = $request->file('hojaVida');
            $seguroMedicoFile = $request->file('seguroMedico');
            $documentoIdentificacionFile = $request->file('documentoIdentificacion');

            //Mover los archivos a la ruta especificada
            $hojaVidaFile->move($contratoDirectory, $hojaVidaFileName);
            $seguroMedicoFile->move($contratoDirectory, $seguroMedicoFileName);
            $documentoIdentificacionFile->move($contratoDirectory, $documentoIdentificacionFileName);

            //Obtener el Path de cada archivo
            $HojaVidaPDFPath = $contratoDirectory . DIRECTORY_SEPARATOR . $hojaVidaFileName;
            $SeguroMedicoPDFPath = $contratoDirectory . DIRECTORY_SEPARATOR . $seguroMedicoFileName;
            $DocumentPDFPath = $contratoDirectory . DIRECTORY_SEPARATOR . $documentoIdentificacionFileName;

            $seguimientoId = $request->input('seguimiento_id');
            
            //Crear el contrato
            Contrato::create([
                'IdSeguimientoProductos' =>  $seguimientoId,
                'HojaVida' => $HojaVidaPDFPath,
                'SeguroMedico' => $SeguroMedicoPDFPath,
                'Documento' => $DocumentPDFPath,
            ]);
            DB::beginTransaction();
            DB::commit();
            session()->forget('success_message');
            session()->flash('success_message', '¡Todos los documentos han sido enviados!');
            session()->put('flash_lifetime', now()->addSeconds(5));
            return redirect()->back();
        } catch (\Exception $e) {
            // En caso de error, maneja la excepción y revierte la transacción
            DB::rollBack();

            session()->forget('error_message');
            session()->flash('error_message', 'Se produjo un error al procesar la solicitud.');
            session()->put('flash_lifetime', now()->addSeconds(5));
            return redirect()->back();
        }
    }
    public function NotficacionesDetalles($noti, $iduser)
    {

        try {
            //Encontrar al usuario del cliente
            $user = User::find($iduser);

            // Encontrar al cliente de ese usuario
            $cliente = $user->cliente;

            $seguimientos = SeguimientoProductos::where('IdCliente', $cliente->IdCliente)
                ->with(['Cliente', 'solicitud' => function ($query) {
                    // Puedes seleccionar los campos que desees incluir en la relación
                    $query->select('IdSolicitud', 'Nombre', /* otros campos si es necesario */);
                }])
                ->get();
            //dd($seguimientos);
            if ($noti == 'Entrevista Avalada') {
                $noti = 'EntrevistaAvalada';
            } elseif ($noti = 'Solicitud Alianza') {
                $noti = 'SolicitudAlianza';
            }
            return view('cliente.RegistroActividad.' . $noti, compact('seguimientos'));
        } catch (\Exception $e) {
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
