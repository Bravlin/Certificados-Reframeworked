<?php

namespace App\Http\Controllers;

use App\Evento;
use App\Perfil;
use App\Caracter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PerfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perfiles = Perfil::orderBy('nombre')->get();
        return view('perfiles.index', compact('perfiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('perfiles.create');
    }

    /**
     * Muestra el formulario para inscribir perfiles de forma masiva.
     *
     * @return \Illuminate\Http\Response
     */
    public function agregarVarios()
    {
        $eventos = Evento::select('id_evento', 'nombre')->orderBy('nombre')->get();
        $caracteres = Caracter::all();
        return view('perfiles.agregar-varios', compact('eventos', 'caracteres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $atributos = $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required',
            'email' => 'required|email|unique:perfil,email',
            'organismo' => 'required',
            'cargo' => 'required',
        ]);
        Perfil::create($atributos);
        return redirect('/perfiles');
    }

    public function storeOrUpdateVarios(Request $request)
    {
        $request->validate([
            'csvFile' => 'required|file|mimes:csv',
            'evento' => 'required|exists:evento',
            'tipo' => 'required|exists:caracter'
        ]);

        Log::info('Procesando archivo para inscripción masiva.');
        $csv = $request('csvFile');
        $ruta = $csv->storeAs('tmp', $csv->getClientOriginalName(), 'public');
        if ($ruta === false) {
            Log::error('Error al subir el archivo.');
            abort(500);
        } else {
            $gestor = fopen($ruta, "r");
            if ($gestor === false) {
                Log::error('Error al tratar de abrir el archivo.');
                abort(500);
            } else {

            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        return view('perfiles.edit', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        $atributos = $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required',
            'email' => 'required|email|unique:perfil,email,'.$perfil->id,
            'organismo' => 'required',
            'cargo' => 'required',
        ]);
        $perfil->update($atributos);
        return redirect('/perfiles#perfil-'.$perfil->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        $perfil->delete();
    }
}
