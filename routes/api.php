<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// rutas de API REST

// contactos
Route::get('obtenerContactos', 'ContactosController@obtenerContactos');
Route::post('crearContacto', 'ContactosController@crearContacto');
Route::post('crearContactoFull', 'ContactosController@crearContactoFull');
Route::post('editarContacto', 'ContactosController@editarContacto');
Route::get('borrarContacto/{idContacto}', 'ContactosController@borrarContacto');

// telefonos
Route::get('obtenerTelefonos', 'TelefonosController@obtenerTelefonos');
Route::post('crearTelefono', 'TelefonosController@crearTelefono');
Route::post('editarTelefono', 'TelefonosController@editarTelefono');
Route::get('borrarTelefono/{idTelefono}/{idContacto}', 'TelefonosController@borrarTelefono');

// correos
Route::get('obtenerCorreos', 'CorreosController@obtenerCorreos');
Route::post('crearCorreo', 'CorreosController@crearCorreo');
Route::post('editarCorreo', 'CorreosController@editarCorreo');
Route::get('borrarCorreo/{idCorreo}/{idContacto}', 'CorreosController@borrarCorreo');

// direcciones
Route::get('obtenerDirecciones', 'DireccionesController@obtenerDirecciones');
Route::post('crearDirecciones', 'DireccionesController@crearDireccion');
Route::post('editarDirecciones', 'DireccionesController@editarDireccion');
Route::get('borrarDirecciones/{idCorreo}/{idContacto}', 'DireccionesController@borrarDireccion');