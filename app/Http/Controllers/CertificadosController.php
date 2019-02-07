<?php

namespace App\Http\Controllers;

use App\Certificado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $certificados = Certificado::juntada(['evento_nombre', 'perfil_nombre', 'perfil_apellido']);
            return view('certificados.index', compact('certificados'));
        } catch (\Throwable $th) {
            abort(500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Certificado  $certificado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Certificado $certificado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Certificado  $certificado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Certificado $certificado)
    {
        $archivo = 'certificados/'.$certificado->nombre_certificado;
        if (Storage::disk('public')->exists($archivo)) {
            Storage::disk('public')->delete('certificados/'.$certificado->nombre_certificado);
            $certificado->delete();
        }
        else
            abort(500);
    }
}
