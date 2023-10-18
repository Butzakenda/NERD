<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Models\Cliente;
use App\Models\MatricularProducto;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
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
        
        
        if ($registerProduct) {
            // Define la ruta base para guardar los PDFs
            $pdfBaseDirectory = public_path('pdfs');

            // Verifica si el directorio de matrículas existe, si no, créalo
            $matriculasDirectory = $pdfBaseDirectory . '/matriculas';
            if (!File::isDirectory($matriculasDirectory)) {
                File::makeDirectory($matriculasDirectory, 0755, true);
            }

            // Verifica si el directorio de peticiones de revisión existe, si no, créalo
            $peticionesDirectory = $pdfBaseDirectory . '/peticionesrevision';
            if (!File::isDirectory($peticionesDirectory)) {
                File::makeDirectory($peticionesDirectory, 0755, true);
            }

            // Genera el primer PDF (CopiaRegistro) y guarda la ruta
            $copiaRegistroPDF = PDF::loadView('administrador.pdfs.copiaregistro', ['copiaRegistro' => $registerProduct]);
            $copiaRegistroPDFPath = $matriculasDirectory . '/' . $id . '_copia_registro.pdf';
            $copiaRegistroPDF->save($copiaRegistroPDFPath);

            // Genera el segundo PDF (PeticionRevision) y guarda la ruta
            $peticionRevisionPDF = PDF::loadView('administrador.pdfs.peticionrevision', ['peticionRevision' => $registerProduct]);
            $peticionRevisionPDFPath = $peticionesDirectory . '/' . $id . '_peticion_revision.pdf';
            $peticionRevisionPDF->save($peticionRevisionPDFPath);

            // Actualiza la columna 'CopiaRegistro' y 'PeticionRevision' en la tabla MatricularProducto
            MatricularProducto::create([
                'IdAdministrador' => $registerProduct->IdAdministrador,
                'IdCliente' => $registerProduct->IdCliente,
                'IdSolicitud' => $registerProduct->IdSolicitud,
                'CopiaRegistro' => $copiaRegistroPDFPath,
                'PeticionRevision' => $peticionRevisionPDFPath,
                'SolicitudAlianza' => '',
                'Fecha' => now(),
            ]);
            return $copiaRegistroPDF->stream();
        }
    }
    /**
     * Show the form for creating a new resource.
     */


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
