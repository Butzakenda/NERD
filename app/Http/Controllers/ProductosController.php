<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Departamentos;
use App\Models\Cliente;
use App\Models\Factura;
use App\Models\Notificaciones;
use App\Http\Controllers\Colaborador;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $productos = Producto::orderBy('IdProducto', 'DESC')
            ->with('colaborador')
            ->with('seguimiento')
            ->paginate(20);
        $fotoPathconNombre = null;
        $productos->each(function ($producto) {
            $nombreArchivoEnDB = null;
            //El producto tiene seguimiento
            //dd($producto);
            if ($producto->seguimiento) {
                $fotoPath = public_path('colaboradores/Products-' . $producto->colaborador->IdColaborador . '/producto-' . $producto->seguimiento->IdSeguimientoProductos);
                $folder = (File::isDirectory($fotoPath));
                if ($folder) {
                    $nombreArchivoEnDB = basename($producto->Foto);
                    $rutaRelativa = str_replace(public_path(), '', $fotoPath);

                    $fotoPathconNombre = $rutaRelativa . '/' . $nombreArchivoEnDB;
                    $fotoPathconNombre = ltrim($fotoPathconNombre, '\\');
                    //dd($fotoPathconNombre);

                    $producto->fotoPathConNombre = $fotoPathconNombre;


                    // Asignar valor solo si $fotoPathconNombre está definido
                    if (!is_null($fotoPathconNombre)) {
                        $fotoPathconNombre = $rutaRelativa . '/' . $nombreArchivoEnDB;
                    }
                }
            }
        });
        return view('producto.index', compact('productos', 'fotoPathconNombre'));
    }

    public function buscar(Request $request)
    {
        $busqueda = $request->input('buscar');

        $resultados = Producto::where('Nombre', 'LIKE', "%$busqueda%")
            ->orWhereHas('colaborador.ciudad', function ($query) use ($busqueda) {
                $query->where('Nombre', 'LIKE', "%$busqueda%");
            })
            ->orWhereHas('colaborador.departamento', function ($query) use ($busqueda) {
                $query->where('Nombre', 'LIKE', "%$busqueda%");
            })
            ->orWhere('Descripcion', 'LIKE', "%$busqueda%")
            ->paginate(5)
            ->appends(['buscar' => $busqueda]);

        return view('producto.resultados', compact('resultados', 'busqueda'));
    }
    public function ComprarProducto(Request $request, $idproducto)
    {
        $factura = null;
        $producto = Producto::where('IdProducto', $idproducto)->first();
        $idCliente = Auth::User()->cliente->IdCliente;
        if (Auth::User()->Tipo == 'Colaborador') {
            $factura = Factura::create([
                'IdProducto' => $producto->IdProducto,
                'IdCliente' => $idCliente,
                'IdColaboradorVenta' => $producto->IdColaborador,
                'IdColaboradorCompra' => Auth::User()->id,
                'FechaHora' => now(),
                'MetodoPago' => $request['flexRadioDefault'],
                'Total' => $producto->Precio,
            ]);
        } else {
            $factura = Factura::create([
                'IdProducto' => $producto->IdProducto,
                'IdCliente' => $idCliente,
                'IdColaboradorVenta' => $producto->IdColaborador,
                'FechaHora' => now(),
                'MetodoPago' => $request['metodoPago'],
                'Total' => $producto->Precio,
            ]);
        }
        
        //Notificar al cliente
        $notificacionCliente = Notificaciones::create([
            'IdCliente' => $idCliente,
            'IdProducto' => $producto->IdProducto,
            'Tipo' => 'Factura',
            'Descripcion' => 'Recientemente has adquirido un producto. Presiona en Más detalles para saber más al respecto.',
            'IdFactura'  =>  $factura->IdFactura
        ]);
        
        //Notificar al colaborador
        $notificacionesColaborador = Notificaciones::create([
            'IdColaborador' => $producto->IdColaborador,
            'IdProducto' => $producto->IdProducto,
            'Tipo' => 'Orden de producto',
            'Descripcion' => 'Recientemente se ha realizado una orden de producto para tu producto. Presiona en Más detalles para saber más al respecto.'
        ]);
        DB::beginTransaction();
        DB::commit();
        session()->forget('success_message');
        session()->flash('success_message', 'Se ha ordenado el producto de la solicitud.');
        session()->put('flash_lifetime', now()->addSeconds(5));
        return redirect()->back();
        try {
        } catch (\Exception $e) {
            DB::rollBack();
            session()->forget('error_message');
            session()->flash('error_message', 'Se produjo un error al procesar la solicitud.');
            session()->put('flash_lifetime', now()->addSeconds(5));
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
