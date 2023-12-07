<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Producto;
use App\Models\User;
use App\Models\Notificaciones;
use App\Models\Colaborador;
use App\Models\Contrato;
use App\Models\Factura;
use App\Models\SeguimientoProductos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

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
            $cliente = null;
            $colaborador = null;
            $notificaciones = null;

            $user = User::find($id);

            $userTipo = $user->tipo;
            if ($userTipo == 'Cliente') {
                $cliente = $user->cliente;
                $notificaciones = Notificaciones::where('IdCliente', $cliente->IdCliente)
                    ->orderBy('IdNotificacion', 'desc')
                    ->paginate(6);
            } elseif ($userTipo == 'Colaborador') {
                $colaborador = $user->colaborador;
                $notificaciones = Notificaciones::where('IdColaborador', $colaborador->IdColaborador)
                    ->orderBy('IdNotificacion', 'desc')
                    ->paginate(6);
            }
            

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
    public function NotficacionesDetalles($noti, $iduser, $idnotificaion)
    {

        try {
            $factura = null;
            //Encontrar al usuario del cliente
            $user = User::find($iduser);
            $vistaNoti = null;
            // Encontrar al cliente de ese usuario
            $cliente = $user->cliente;
            //Obtener las notificaciones que llevan enlaceRelacionado
            $notificacion = Notificaciones::where('IdNotificacion', $idnotificaion)
                ->with('factura')
                ->first();


            //Obtener la notificación correspondiente
            /* $notificaciones = Notificaciones::where('IdNotificacion',$idnotificaion)->get();
            
            $notificaciones->each(function ($factura) {
                $factura = Factura::where('IdFactura', $factura->enlaceRelacionado)->first();
            }); */



            $seguimientos = SeguimientoProductos::where('IdCliente', $cliente->IdCliente)
                ->with(['Cliente', 'solicitud' => function ($query) {
                    $query->select('IdSolicitud', 'Nombre');
                }])
                ->get();
            
            if ($noti == 'Entrevista Avalada') {
                $vistaNoti = 'EntrevistaAvalada';
            } elseif ($noti == 'Solicitud Alianza') {
                $vistaNoti = 'SolicitudAlianza';
            } elseif ($noti == 'Factura') {

                $vistaNoti = 'Producto';
            }


            return view('cliente.RegistroActividad.' . $vistaNoti, compact('seguimientos', 'notificacion'));
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
