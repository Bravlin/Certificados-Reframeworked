<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/provincias/{provincia}/ciudades', 'ProvinciaCiudadesController@selectCiudades')->name('provincia.ciudades');

Route::group(['middleware' => 'administrador_guest'], function() {
    Route::get('/administradores/login', 'AdministradorController@showLoginForm');
    Route::post('/administradores/login', 'AdministradorController@login')->name('administradores.login');
});

Route::group(['middleware' => 'administrador_auth'], function() {
    Route::get('/', 'InicioController@index');

    Route::get('/perfiles/agregar-masivo', 'InscripcionMasivaController@agregarMasivo')->name('perfiles.agregar-masivo');
    Route::post('/perfiles/agregar-masivo', 'InscripcionMasivaController@storeOrUpdateMasivo')->name('pefiles.store-update-masivo');

    Route::resource('perfiles', 'PerfilesController', ['parameters' => [
        'perfiles' => 'perfil'
    ]])->except(['show']);

    Route::get('/eventos/{evento}/administrar', 'EventosController@administrar')->name('eventos.administrar');
    Route::resource('eventos', 'EventosController', ['parameters' => [
        'eventos' => 'evento'
    ]])->except(['show', 'edit']);

    Route::resource('inscripciones', 'InscripcionesController', ['parameters' => [
        'inscripciones' => 'inscripcion'
    ]])->only(['store', 'update', 'destroy']);

    Route::get('/eventos/{evento}/certificados', 'CertificadosController@indexEvento')->name('eventos.certificados');
    Route::post('/eventos/{evento}/certificados', 'CertificadosController@generarTodos')->name('certificados.generar_todos');
    Route::get('/perfiles/{perfil}/certificados', 'CertificadosController@indexPerfil')->name('perfiles.certificados');
    Route::post('/certificados/inscripciones/{inscripcion}', 'CertificadosController@generarIndividual')->name('certificados.generar_individual');
    Route::resource('certificados', 'CertificadosController', ['parameters' => [
        'certificados' => 'certificado'
    ]])->only(['index', 'update', 'destroy']);

    Route::prefix('emails')->group(function () {
        Route::post('/inscripciones/{inscripcion}', 'MailController@envioCertificadoIndividual')->name('emails.certificado_individual');
        Route::post('/eventos/{evento}', 'MailController@envioCertificadosMasivo')->name('emails.certificados_masivo');
    });

    Route::get('/administradores/logout', 'AdministradorController@logout')->name('administradores.logout');
});
