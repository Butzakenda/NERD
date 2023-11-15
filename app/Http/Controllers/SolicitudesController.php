<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Models\Cliente;
use App\Models\MatricularProducto;
use App\Models\Notificaciones;
use App\Models\Documentos;
use App\Models\RevisarProducto;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\alert;

class SolicitudesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

    }
    public function create(Request $request)
    {
        $cliSA = Cliente::where('user_id', auth()->id())->first();

        Solicitud::create([
            'Nombre' => $request['nombreProductoSA'],
            'Descripcion' => $request['descripcionProductoSA'],
            'IdCliente' => $cliSA->IdCliente,
            'Fecha' => now()
        ]);
    }
    public function registerProduct(string $id)
    {

        try {
            $registerProduct = Solicitud::where('IdSolicitud', $id)->first();
            if ($registerProduct) {
                // Obtener el ID del cliente
                $idCliente = $registerProduct->IdCliente;

                $cliente = Cliente::where('IdCliente', $idCliente)->first();

                // Define la ruta base para guardar los PDFs
                $pdfBaseDirectory = public_path('pdfs');

                // Define el nombre de la carpeta del cliente
                $clienteFolder = 'Documents-' . $idCliente;

                // Verifica si la carpeta del cliente existe, si no, créala
                $clienteDirectory = $pdfBaseDirectory . '/' . $clienteFolder;
                if (!File::isDirectory($clienteDirectory)) {
                    File::makeDirectory($clienteDirectory, 0755, true);
                }

                // Verifica si el directorio "matriculas" existe en la carpeta del cliente, si no, créalo
                $matriculasDirectory = $clienteDirectory . '/matriculas';
                if (!File::isDirectory($matriculasDirectory)) {
                    File::makeDirectory($matriculasDirectory, 0755, true);
                }
                // Verifica si el directorio "peticionesrevision" existe en la carpeta del cliente, si no, créalo
                $peticionesDirectory = $clienteDirectory . '/peticionesrevision';
                if (!File::isDirectory($peticionesDirectory)) {
                    File::makeDirectory($peticionesDirectory, 0755, true);
                }
                $solicitudAlianzaDirectory = $clienteDirectory . '/solicitudalianza';
                // Verifica si el directorio "solicitudalianza" existe en la carpeta del cliente, si no, créalo
                if (!File::isDirectory($solicitudAlianzaDirectory)) {
                    File::makeDirectory($solicitudAlianzaDirectory, 0755, true);
                }
                // Genera y guarda el primer PDF (CopiaRegistro) en la carpeta del cliente
                $copiaRegistroPDF = PDF::loadView('administrador.pdfs.copiaregistro', ['copiaRegistro' => $registerProduct]);
                $copiaRegistroPDFPath = $matriculasDirectory . '/' . $idCliente . '_copia_registro.pdf';
                $copiaRegistroPDF->save($copiaRegistroPDFPath);

                // Genera y guarda el segundo PDF (PeticionRevision) en la carpeta del cliente
                $peticionRevisionPDF = PDF::loadView('administrador.pdfs.peticionrevision', ['peticionRevision' => $registerProduct]);
                $peticionRevisionPDFPath = $peticionesDirectory . '/' . $idCliente . '_peticion_revision.pdf';
                $peticionRevisionPDF->save($peticionRevisionPDFPath);

                // Genera y guarda el tercer PDF (SolicitudAlianza) en la carpeta "solicitudalianza"
                $solicitudAlianzaPDF = PDF::loadView('administrador.pdfs.solicitudalianza', ['solicitudalianza' => $registerProduct]);
                $solicitudAlianzaPDFPath = $solicitudAlianzaDirectory . '/' . $idCliente . '_solicitud_alianza.pdf';
                $solicitudAlianzaPDF->save($solicitudAlianzaPDFPath);


                MatricularProducto::create([
                    'IdAdministrador' => $registerProduct->IdAdministrador,
                    'IdCliente' => $registerProduct->IdCliente,
                    'IdSolicitud' => $registerProduct->IdSolicitud,
                    'CopiaRegistro' => $copiaRegistroPDFPath,
                    'PeticionRevision' => $peticionRevisionPDFPath,
                    'SolicitudAlianza' => $solicitudAlianzaPDFPath,
                    'Fecha' => now(),
                ]);
                $registerProduct->update([
                    'Estado' => 'Convocado a Entrevista'
                ]);
                $cliente->update([
                    'SolicitudAlianza' => $solicitudAlianzaPDFPath,
                ]);
                Documentos::create([
                    'IdCliente' => $registerProduct->IdCliente,
                    'tipo' => 'Copia de Registro',
                    'ruta' => $copiaRegistroPDFPath,
                    'fechaCarga' => now(),
                ]);
                Documentos::create([
                    'IdCliente' => $registerProduct->IdCliente,
                    'tipo' => 'Peticion de Revisión',
                    'ruta' => $peticionRevisionPDFPath,
                    'fechaCarga' => now(),
                ]);
                Documentos::create([
                    'IdCliente' => $registerProduct->IdCliente,
                    'tipo' => 'Solicitud de Alianza',
                    'ruta' => $solicitudAlianzaPDFPath,
                    'fechaCarga' => now(),
                ]);
            }
            DB::beginTransaction();
            DB::commit();
            if ($copiaRegistroPDF && $peticionRevisionPDF && $solicitudAlianzaPDF) {
                session()->forget('success_message');
                session()->flash('success_message', '¡Todos los PDFs se han creado exitosamente!');
                session()->put('flash_lifetime', now()->addSeconds(5)); // Establece una duración de 5 minutos
            }

            return redirect()->back();
        } catch (Exception $e) {
            // En caso de error, maneja la excepción y revierte la transacción
            DB::rollBack();

            // Agregar lógica para manejar el error (por ejemplo, mostrar un mensaje de error)
            session()->forget('error_message');
            session()->flash('error_message', 'Se produjo un error al procesar la solicitud.');
            session()->put('flash_lifetime', now()->addSeconds(5));
            // Puedes redirigir a una página de error o a donde sea necesario
            return redirect()->back();
        }
    }

    public function EntrevistaAprobada($id)
    {
        try {
            $MatricularProducto = MatricularProducto::with('Cliente', 'administrador')
                ->where('IdCliente', $id)
                ->latest()
                ->first();
            /* dd($MatricularProducto ); */
            // Definir el directorio base
            $pdfBaseDirectory = public_path('pdfs');
            // Obtener el ID del cliente
            $idCliente = $MatricularProducto->IdCliente;
            // Define el nombre de la carpeta del cliente
            $clienteFolder = 'Documents-' . $idCliente;
            // Verifica si la carpeta del cliente existe, si no, créala
            $clienteDirectory = $pdfBaseDirectory . '/' . $clienteFolder;
            if (!File::isDirectory($clienteDirectory)) {
                File::makeDirectory($clienteDirectory, 0755, true);
            }
            // Verifica si la carpeta avalrevision existe dentro de $clienteDirectory, si no créala
            $avalDirectory = $clienteDirectory . '/avalrevision';
            if (!File::isDirectory($avalDirectory)) {
                File::makeDirectory($avalDirectory, 0755, true);
            }
            $avalrevisionPDF = PDF::loadView('administrador.pdfs.avalrevision', ['MatricularProducto' => $MatricularProducto]);
            $avalrevisionPDFPath = $avalDirectory . '/' . $idCliente . '_aval_revision.pdf';
            $avalrevisionPDF->save($avalrevisionPDFPath);
            RevisarProducto::create([
                'IdMatricularProducto' => $MatricularProducto->IdMatricularProducto, 
                'AvalRevision' => $avalrevisionPDFPath, /* Ruta */
                'Fecha' => now(), /* Actual */
            ]);
            DB::beginTransaction();
            DB::commit();
            if ($avalrevisionPDF) {
                session()->forget('success_message');
                session()->flash('success_message', '¡El aval ha sido creado exitosamente!');
                session()->put('flash_lifetime', now()->addSeconds(5)); // Establece una duración de 5 minutos
            }
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();

            // Agregar lógica para manejar el error (por ejemplo, mostrar un mensaje de error)
            session()->forget('error_message');
            session()->flash('error_message', 'Se produjo un error al procesar la solicitud.');
            session()->put('flash_lifetime', now()->addSeconds(5));
            // Puedes redirigir a una página de error o a donde sea necesario
            return redirect()->back();
        }
    }
    public function EntrevistaDenegada()
    {
    }


    /**
     * Show the form for creating a new resource.
     */

    public function solicitudAlianzaRechazada(Request $request, $id, $idcliente)
    {

        $solicitudCliente = Solicitud::where('IdSolicitud', $id)->first();
        Notificaciones::create([
            'IdCliente' => $idcliente,
            'IdAdministrador' => Auth::user()->id,
            'Tipo' => $solicitudCliente->Tipo,
            'Descripcion' => $request->input('motivoRechazo'),
        ]);
        $solicitudCliente->update([
            'Estado' => 'Rechazada',
        ]);
        if ($solicitudCliente->Estado == 'Rechazada') {
            session()->forget('reject_success_message'); // Elimina la variable de sesión si existe
            session()->flash('reject_success_message', '¡La solicitud ha sido rechazada exitosamente!');
            session()->put('flash_lifetime', now()->addSeconds(5));
            return redirect()->back();
        } else {
            session()->forget('reject_error_message'); // Elimina la variable de sesión si existe
            session()->flash('reject_error_message', '¡Algo ha salido mal!');
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
