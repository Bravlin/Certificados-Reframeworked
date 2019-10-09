<?php

namespace App\Http\Controllers;

use App\Inscripcion;
use App\Perfil;
use Illuminate\Http\Request;

class InscripcionesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos = $request->validate([
            'idEvento' => 'required',
            'idPerfil' => 'required',
            'tipo' => 'required'
        ]);
        $inscripcion = Inscripcion::create([
            'tipo' => $campos['tipo'],
            'fk_perfil' => $campos['idPerfil'],
            'fk_evento' => $campos['idEvento']
        ]);
        return view('eventos.inscripciones.fila', compact('inscripcion'));
    }

    public function storePublico(Request $request)
    {
        $atributos = $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required',
            'email' => 'required|email',
            'organismo' => 'required',
            'cargo' => 'required',
        ]);
        $perfil = Perfil::updateOrCreate(
            ['email' => $atributos['email']],
            [
                'nombre' => $atributos['nombre'],
                'apellido' => $atributos['apellido'],
                'telefono' => $atributos['telefono'],
                'organismo' => $atributos['organismo'],
                'cargo' => $atributos['cargo']
            ]
        );
        if (Inscripcion::where('fk_perfil',  $perfil->id)
                ->where('fk_evento', $request['idEvento'])
                ->first())
            return back()->with('estado', 'Error: usted ya está inscripto.');
        Inscripcion::create([
            'tipo' => 'Asistente',
            'fk_perfil' => $perfil->id,
            'fk_evento' => $request['idEvento']
        ]);
        return back()->with('estado', 'Inscripción correcta.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inscripcion $inscripcion)
    {
        $inscripcion->update($request->validate([
            'asistencia' => 'required|integer|between:-1,1'
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inscripcion $inscripcion)
    {
        $inscripcion->delete();
    }
}
