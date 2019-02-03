<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provincia;

class ProvinciaCiudadesController extends Controller
{
    public function selectCiudades(Provincia $provincia)
    {
        $ciudades = $provincia->ciudades;
        return view('ciudades.select', compact('ciudades'));
    }
}
