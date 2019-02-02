<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provincia;

class ProvinciaCiudadesController extends Controller
{
    public function selectCiudades(Provincia $provincia)
    {
        $ciudades = Provincia::find($provincia->id_provincia)->ciudades;
        return view('ciudades.select', compact('ciudades'));
    }
}
