<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Models\Cliente;
use App\Models\MatricularProducto;
use App\Models\Notificaciones;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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
        $registerProduct = Solicitud::where('IdSolicitud', $id)->first();
        $DetalleSolicitud = Cliente::with('departamento', 'ciudad', 'solicitudes')->find($id);
        $notificacionesCliente = Notificaciones::where('IdCliente', $id)->first();;
        if ($registerProduct) {
            // Obtener el ID del cliente
            $idCliente = $registerProduct->IdCliente;


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

            // Actualiza la columna 'CopiaRegistro' y 'PeticionRevision' en la tabla MatricularProducto
            MatricularProducto::create([
                'IdAdministrador' => $registerProduct->IdAdministrador,
                'IdCliente' => $registerProduct->IdCliente,
                'IdSolicitud' => $registerProduct->IdSolicitud,
                'CopiaRegistro' => $copiaRegistroPDFPath,
                'PeticionRevision' => $peticionRevisionPDFPath,
                'SolicitudAlianza' => $solicitudAlianzaPDFPath,
                'Fecha' => now(),
            ]);

            if ($copiaRegistroPDF && $peticionRevisionPDF && $solicitudAlianzaPDF) {
                session()->flash('success_message', '¡Todos los PDFs se han creado exitosamente!');
                session()->put('flash_lifetime', now()->addSeconds(5)); // Establece una duración de 5 minutos
            }

            return redirect()->back();
        }
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
        return redirect()->back();
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
