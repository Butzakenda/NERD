<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Colaborador;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Producto;
use App\Models\Departamentos;
use App\Models\Cliente;
use App\Models\Factura;


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
//Listar departamentos en la vista auth.register
    Route::get('login/departamentos','departamentosController@index')->name('departamentos.index');
/* Route::get('session/cliente','ClienteController@index')->name('cliente.index'); */
Route::get('session/index','SessionController@index')->name('sesion.index');
//Cliente
    Route::get('session/RegistroActividad/{id}','SessionController@RegistroActividad')->name('sesion.actividad');
    //Actualizar
    Route::put('cliente/update/{id}','ClienteController@update')->name('cliente.update');
    Route::get('cliente/edit/{id}','ClienteController@edit')->name('cliente.edit');
    Route::post('/crear-solicitud-alianza', 'SolicitudesController@create')->name('cliente.crearSolicitudAlianza');
    //Cambiar contraseña
    Route::get('/change-password', 'ClienteController@showChangePasswordForm')->name('cliente.changePasswordForm');
    Route::post('/update-password', 'ClienteController@updatePassword')->name('cliente.updatePassword');
    //Solicitar ALianza
    Route::get('/solicitar-alianza', 'ClienteController@solicitarAlianzaForm')->name('cliente.solicitarAlianzaForm');
//-----------------

//Producto
Route::get('session/productos','ProductosController@index')->name('productos.index');
//Buscar
Route::get('/buscar', 'ProductosController@buscar')->name('buscar');


Route::post('/enviar-solicitud-alianza', 'ClienteController@enviarSolicitudAlianza')->name('cliente.enviarSolicitudAlianza');

/* Route::view('/inicio', 'inicio')->name('inicio'); */

/* Administrador */
    //Mostrar el formulario para crear un colaborador
    Route::get('/crear-colaborador','ColaboradorController@showCrearColaboradorForm')->name('administrador.create');
    //Mostrar las solicitudes
    Route::get('/show/solictudes','AdministradorController@showSolicitudes')->name('solicitudes.show');
    //Ver los detalles de una solicitud
    Route::get('/show/solictudes/detalles/{id}','AdministradorController@showSolicitudesDetalles')->name('solicitudes.ver');
    //Cambiar el Estado de una solicitud a Citado a Entrevista
    Route::post('/show/solictudes/detalles/estado/{id}','SolicitudesController@registerProduct')->name('solicitudes.servicio');
    //Enviar rechazo de solicitud
    Route::post('/show/solictudes/detalles/rejected/{id}/{idcliente}','SolicitudesController@solicitudAlianzaRechazada')->name('solicitudes.rejected');
    //Retornar la vista para agendar entrevista
    Route::get('/show/solictudes/entrevista/{id}','AdministradorController@showEntrevistaForm')->name('solicitudes.entrevista');
    //Retornar la pestaña para agendar entrevistas
    Route::get('/show/solictudes/entrevista/agendar/{idEntrevista}','AdministradorController@agendarReunion')->name('solicitudes.agendarReunion');
    //Añadir los campos si se aprueba la entrevista
    Route::post('/solicitudes/AvalRevisionAprobado/{id}','SolicitudesController@EntrevistaAprobada')->name('solicitudes.EntrevistaAprobada');
    //Añadir los campos si no se aprueba la entrevista
    Route::post('/solicitudes/AvalRevisionDenegado/{id}','SolicitudesController@EntrevistaDenegada')->name('solicitudes.EntrevistaDenegada');

    
/* -------------- */    
/* -------------- */
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
