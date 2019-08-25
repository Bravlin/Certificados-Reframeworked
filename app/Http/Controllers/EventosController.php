<?php

namespace App\Http\Controllers;

use App\Evento;
use App\Perfil;
use App\Caracter;
use App\Provincia;
use Illuminate\Http\Request;

class EventosController extends Controller
{
    private function validarAtributos(Request $request)
    {
        return $request->validate([
            'nombre' => 'required',
            'direccion_calle' => 'required',
            'direccion_altura' => 'required|integer|min:1',
            'provincia' => 'required',
            'ciudad' => 'required',
            'fecha_realizacion' => 'required|date|after:now',
            'portada' => 'mimes:jpeg,png,jpg|max:5000',
            'descripcion' => 'nullable'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $eventos = Evento::juntada('fecha_realizacion', 'des')
                ->groupBy(function ($evento, $key) {
                    return \Carbon\Carbon::parse($evento->fecha_realizacion)->format('Y');
                });
            return view('eventos.index', compact('eventos'));
        } catch (\Throwable $th) {
            abort(500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provincias = Provincia::orderBy('nombre')->get();
        return view('eventos.create', compact('provincias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos = $this->validarAtributos($request);
        $nuevoEvento = Evento::create([
            'nombre' => $campos['nombre'],
            'descripcion' => $campos['descripcion'],
            'direccion_calle' => $campos['direccion_calle'],
            'direccion_altura' => $campos['direccion_altura'],
            'fk_ciudad' => $campos['ciudad'],
            'fecha_realizacion' => $campos['fecha_realizacion'],
            'fecha_creacion' => date("Y-m-d H:i:s")
        ]);
        if ($request->hasFile('portada'))
            $request->file('portada')->storeAs('media/portadas-eventos', $nuevoEvento->id_evento.'-p', 'public');
        return redirect('/eventos');
    }

    /**
     * Devuelve la vista para visualizar y gestionar el evento dado.
     *
     * @param \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function administrar(Evento $evento)
    {
        $provincias = Provincia::orderBy('nombre')->get();
        $perfiles = Perfil::orderBY('nombre')->get();
        $caracteres = Caracter::all();
        return view('eventos.administrar', compact('evento', 'provincias', 'perfiles', 'caracteres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evento $evento)
    {
        $campos = $this->validarAtributos($request);
        $evento->update([
            'nombre' => $campos['nombre'],
            'descripcion' => $campos['descripcion'],
            'direccion_calle' => $campos['direccion_calle'],
            'direccion_altura' => $campos['direccion_altura'],
            'fk_ciudad' => $campos['ciudad'],
            'fecha_realizacion' => $campos['fecha_realizacion'],
        ]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evento $evento)
    {
        $evento->delete();
    }
}
