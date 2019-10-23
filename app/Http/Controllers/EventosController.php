<?php

namespace App\Http\Controllers;

use App\Evento;
use App\Perfil;
use App\Caracter;
use App\Categoria;
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
            'descripcion' => 'nullable',
            'categoria' => 'required'
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
            $eventos = Evento::join('ciudad', 'evento.fk_ciudad', '=', 'ciudad.id_ciudad')
                ->join('provincia', 'ciudad.fk_provincia', '=', 'provincia.id_provincia')
                ->join('categoria', 'evento.fk_categoria', '=', 'categoria.id_categoria')
                ->select('evento.*', 'ciudad.nombre as nombre_ciudad', 'provincia.nombre as nombre_provincia',
                    'categoria.nombre as nombre_categoria')
                ->orderBy('fecha_realizacion', 'des')
                ->take(10)
                ->get()
                ->groupBy(function ($evento, $key) {
                    return \Carbon\Carbon::parse($evento->fecha_realizacion)->format('Y');
                });
            return view('eventos.index', compact('eventos'));
        } catch (\Throwable $th) {
            abort(500);
        }
    }

    public function publico()
    {
        try {
            $eventos = Evento::join('ciudad', 'evento.fk_ciudad', '=', 'ciudad.id_ciudad')
                ->join('provincia', 'ciudad.fk_provincia', '=', 'provincia.id_provincia')
                ->join('categoria', 'evento.fk_categoria', '=', 'categoria.id_categoria')
                ->where('fecha_realizacion', '>',  date('Y-m-d H:i:s'))
                ->select('evento.*', 'ciudad.nombre as nombre_ciudad', 'provincia.nombre as nombre_provincia',
                    'categoria.nombre as nombre_categoria')
                ->orderBy('fecha_realizacion', 'asc')
                ->get();
            return view('eventos.publico', compact('eventos'));
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
        $categorias = Categoria::orderBy('nombre')->get();
        return view('eventos.create', compact('provincias', 'categorias'));
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
            'fecha_creacion' => date("Y-m-d H:i:s"),
            'fk_categoria' => $campos['categoria']
        ]);
        if ($request->hasFile('portada'))
            $request->file('portada')->storeAs('media/portadas-eventos', $nuevoEvento->id_evento.'-p', 'public');
        return redirect('/eventos');
    }

    /**
     * Devuelve la vista para visualizar el evento dado.
     *
     * @param \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function show(Evento $evento)
    {
        return view('eventos.show', compact('evento'));
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
        $perfiles = Perfil::orderBy('nombre')->get();
        $caracteres = Caracter::all();
        $categorias = Categoria::orderBy('nombre')->get();
        return view('eventos.administrar', compact('evento', 'provincias', 'perfiles', 'caracteres',
            'categorias'));
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
            'fk_categoria' => $campos['categoria']
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
