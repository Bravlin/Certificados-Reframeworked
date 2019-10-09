<?php

namespace App\Http\Controllers;

use App\Evento;

class InicioController extends Controller
{
    public function index()
    {
        try {
            $eventos = Evento::juntada('fecha_creacion', 'des');
            return view('administradores.index', compact('eventos'));
        } catch (\Throwable $th) {
            abort(500);
        }
    }
}
