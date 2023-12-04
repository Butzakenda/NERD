<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Colaborador;
use App\Models\SeguimientoProductos;
use App\Models\Departamentos;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class ColaboradorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function mostrarFormularioRegistro($idColaborador)
    {


        $Colaborador = Colaborador::where('IdColaborador', $idColaborador)->first();

        return view('colaborador.registro', compact('Colaborador'));
    }

    public function procesarFormularioRegistro(Request $request, $idColaborador)
    {
        try {
            $Colaborador = Colaborador::where('IdColaborador', $idColaborador)->first();

            $user = User::create([
                'name' => $Colaborador->Nombres,
                'email' => $request['correoColaborador'],
                'tipo' => 'Colaborador',
                'password' => Hash::make($request['passwordColaborador']),
            ]);
            $Colaborador->update([
                'user_id' => $user->id
            ]);
            return view('inicio')->with('success', 'Colaborador registrado exitosamente.');
        } catch (\Exception $e) {
            return view('inicio')->with('error', 'Ha ocurrido un problema');
        }
    }
    public function MostrarProductos($id)
    {

        $colaborador = Colaborador::where('user_id', $id)
            ->with('producto')
            ->first();
        //dd($colaborador);
        return view('colaborador.productos', compact('colaborador'));
    }
    public function CrearProductoForm($id)
    {
        $colaborador = Colaborador::where('user_id', $id)
            ->with('ciudad')
            ->with('departamento')
            ->with('producto')
            ->first();
        $departamentos = departamentos::OrderBy('IdDepartamento', 'ASC')->with('ciudades')->get();
        //$fotoPath = asset('Colaboradores/Products-' . $colaborador->IdColaborador . '/contrato/23_seguro_medico.pdf');
        $categoria = Categoria::OrderBy('Nombre', 'ASC')->get();
        return view('colaborador.crearProducto', compact('colaborador', 'departamentos', 'categoria'));
    }
    public function CrearProducto(Request $request, $id)
    {
        try {
            $colaborador = Colaborador::where('user_id', $id)
                ->with('ciudad')
                ->with('departamento')
                ->first();
            $seguimiento = SeguimientoProductos::where('IdColaborador', $colaborador->IdColaborador)->first();
            //dd($request);
            // Definir el directorio base
            $pdfBaseDirectory = public_path('colaboradores');
            // Obtener el ID del colaborador
            $IdColaborador = $colaborador->IdColaborador;
            //Obtener el id del seguimiento
            $idSeguimiento = $seguimiento->IdSeguimientoProductos;
            // Define el nombre de la carpeta del Colaborador
            $colaboradorFolder = 'Products-' . $IdColaborador;
            // Verifica si la carpeta del Colaborador existe, si no, créala
            $colaboradorDirectory = $pdfBaseDirectory . '/' . $colaboradorFolder;
            if (!File::isDirectory($colaboradorDirectory)) {
                File::makeDirectory($colaboradorDirectory, 0755, true);
            }
            // Verifica si la carpeta del Producto existe dentro de $colaboradorDirectory, si no créala
            $productoDirectory = $colaboradorDirectory . '/producto-' . $idSeguimiento;
            if (!File::isDirectory($productoDirectory)) {
                File::makeDirectory($productoDirectory, 0755, true);
            }
            $fotoProducto = $request->file('fotoProductoInput');
            
            if ($fotoProducto) {
                // Generar un nombre único para el archivo
                $nombreArchivo = time() . '_' . $fotoProducto->getClientOriginalName();
            
                // Guardar la foto en la ruta específica
                $rutaFoto = $productoDirectory . '/' . $nombreArchivo;
                $fotoProducto->move($productoDirectory, $nombreArchivo);
            }
            $fotoPath = $productoDirectory . '/' . $IdColaborador . $nombreArchivo ;
            
            
            $producto = Producto::Create([
                'IdSeguimientoProductos' => $idSeguimiento,
                'IdDepartamento' => $request['departamentoProductoInput'],
                'IdCiudad' => $request['ciudadProductoInput'],
                'IdCategoria' => $request['categoriaProductoInput'],
                'IdColaborador' => $IdColaborador,
                'Nombre' => $request['nombreProductoInput'],
                'Precio' => $request['precioProductoInput'],
                'Descripcion' => $request['descripcionProductoInput'],
                'Foto' => $fotoPath,
            ]);
            DB::beginTransaction();
            DB::commit();
            session()->forget('success_message');
            session()->flash('success_message', '¡Se ha creado el producto!');
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
    public function index()
    {
        //
    }
    public function showCrearColaboradorForm()
    {
        return view('administrador.crear-colaborador');
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
