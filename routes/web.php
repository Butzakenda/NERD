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
Route::get('session', function () {
    /* dd($productoChunks); */
    return view('session');
});
Route::get('emails/solicitarAlianza', function () {
    /* dd($productoChunks); */
    return view('emails/solicitarAlianza');
});

Route::get('/',function (){
    $productos = Producto::orderBy('IdColaborador', 'desc')->with('colaborador')->get();
    $productoChunks = $productos->chunk(4);
    /* dd($productoChunks); */
    return view('inicio', compact('productos','productoChunks'));
});

Route::get('login/departamentos','departamentosController@index')->name('departamentos.index');
Route::get('session/cliente','ClienteController@index')->name('cliente.index');
Route::put('cliente/update/{id}','ClienteController@update')->name('cliente.update');
Route::get('cliente/edit/{id}','ClienteController@edit')->name('cliente.edit');
Route::get('session/index','SessionController@index')->name('sesion.index');
//Cambiar contraseña
Route::get('/change-password', 'ClienteController@showChangePasswordForm')->name('cliente.changePasswordForm');
Route::post('/update-password', 'ClienteController@updatePassword')->name('cliente.updatePassword');
//Producto
Route::get('session/productos','ProductosController@index')->name('productos.index');
//Buscar
Route::get('/buscar', 'ProductosController@buscar')->name('buscar');
//Solicitar ALianza
Route::get('/solicitar-alianza', 'ClienteController@solicitarAlianzaForm')->name('cliente.solicitarAlianzaForm');
Route::post('/enviar-solicitud-alianza', 'ClienteController@enviarSolicitudAlianza')->name('cliente.enviarSolicitudAlianza');

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
