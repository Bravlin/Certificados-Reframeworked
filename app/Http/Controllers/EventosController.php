<?php

namespace App\Http\Controllers;

use App\Evento;
use Illuminate\Http\Request;
use App\Provincia;

class EventosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $eventos = Evento::juntada('nombre');
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
        $campos = request()->validate([
            'nombre' => 'required',
            'direccion_calle' => 'required',
            'direccion_altura' => 'required|integer|min:1',
            'provincia' => 'required',
            'ciudad' => 'required',
            'fecha_realizacion' => 'required|date|after:now',
            'portada' => 'mimes:jpeg,png,jpg|max:5000'
        ]);
        $nuevoEvento = Evento::create([
            'nombre' => $campos['nombre'],
            'direccion_calle' => $campos['direccion_calle'],
            'direccion_altura' => $campos['direccion_altura'],
            'fk_ciudad' => $campos['ciudad'],
            'fecha_realizacion' => $campos['fecha_realizacion'],
            'fecha_creacion' => date("Y-m-d H:i:s")
        ]);
        if ($request->hasFile('portada'))
            $path = $request->file('portada')->storeAs(
                'media/portadas-eventos', $nuevoEvento->id_evento.'-p', 'public'
            );
        return redirect('/eventos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function show(Evento $evento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function edit(Evento $evento)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evento $evento)
    {
        //
    }
}
