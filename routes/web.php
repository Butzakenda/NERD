<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Colaborador;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Producto;
use App\Models\Departamentos;
use App\Models\Cliente;
use App\Models\Factura;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    /* dd($productoChunks); */
    return view('index');
});
Route::get('inicio', function () {
    /* dd($productoChunks); */
    return view('inicio');
});

Route::get('inicio',function (){
    $productos = Producto::orderBy('IdColaborador', 'desc')->with('colaborador')->get();
    /* $ciudades = DB::table('departamentos')
                    ->join('ciudades','ciudades.iddepartamento','=','departamentos.iddepartamento')
                    ->select('ciudades.idciudad','departamentos.iddepartamento','departamentos.nombre as dep','ciudades.nombre')
                    ->orderby('departamentos.nombre','ASC') 
                    ->orderby('ciudades.nombre','ASC')    
                    ->get(); */
   /*  $productos = DB::table('productos')
                    ->join('colaboradores', 'colaboradores.IdColaborador', '=', 'productos.IdColaborador')
                    ->join('facturas', 'facturas.IdProducto', '=', 'productos.IdProducto')
                    ->join('clientes', 'clientes.IdCliente', '=', 'facturas.IdCliente')
                    ->select(
                        'colaboradores.IdColaborador',
                        'colaboradores.Nombres as NombreColaborador',
                        'colaboradores.Apellidos as ApellidoColaborador',
                        'facturas.IdFactura',
                        'clientes.IdCliente',
                        'clientes.Nombres as NombreCliente',
                        'clientes.Apellidos as ApellidoCliente',
                        'clientes.Foto as ClienteFoto'
                    )
                    ->orderBy('colaboradores.Nombres', 'ASC')
                    ->orderBy('colaboradores.Apellidos', 'ASC')
                    ->get();
                 */
    $cliente = Cliente::OrderBy('IdCliente','ASC')->get();
    /* dd($productos); */
    /* dd(count($productos)); */
    $productoChunks = $productos->chunk(4);
    /* dd($productoChunks); */
    return view('inicio', compact('productos','productoChunks','cliente'));
});

Route::get('login/departamentos','departamentosController@index')->name('departamentos.index');

/* Route::view('/inicio', 'inicio')->name('inicio'); */

Auth::routes();

Route::middleware(['web'])->group(function () {
    // Aquí van las rutas de autenticación
    //Register
        Route::post('registro', 'App\Http\Controllers\Auth\RegisterController@create')->name('register');
        
    //--------
    //Login
        Route::post('/login', 'Auth\LoginController@login');
        Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    //--------
    //logout
        Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    //--------
});
Route::get('index/login','WelcomeController@index')->name('login.index');

Route::get('/index/buscarciudad/{id}','DepartamentosController@consultarCiudades')->name('buscarciudades');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
