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

    Route::resource('perfiles', 'PerfilesController', ['parameters' => [
        'perfiles' => 'perfil'
    ]])->except(['show']);

    Route::get('/eventos/{evento}/administrar', 'EventosController@administrar')->name('eventos.administrar');
    Route::resource('eventos', 'EventosController', ['parameters' => [
        'eventos' => 'evento'
    ]])->except(['show', 'edit']);

    Route::get('/administradores/logout', 'AdministradorController@logout')->name('administradores.logout');
});
