<?php

namespace App\Http\Controllers;

use App\Caracter;
use App\Inscripcion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
