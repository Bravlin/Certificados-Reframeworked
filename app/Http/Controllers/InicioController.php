<?php

namespace App\Http\Controllers;

use App\Evento;

class InicioController extends Controller
{
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
                ->get();
            return view('administradores.index', compact('eventos'));
        } catch (\Throwable $th) {
            abort(500);
        }
    }
}
