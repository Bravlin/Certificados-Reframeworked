<?php

namespace App\Http\Controllers;

use App\Inscripcion;
use Illuminate\Http\Request;
use App\Mail\EnvioCertificado;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MailController extends Controller
{
    private function validarEnvioCertificado(Request $request)
    {
        return $request->validate([
            'remitente' => 'required|email',
            'asunto' => 'required',
            'cuerpo_mail' => 'required'
        ]);
    }

    public function envioCertificadoIndividual(Request $request, Inscripcion $inscripcion)
    {
        $campos = $this->validarEnvioCertificado($request);
        $certificado = $inscripcion->certificado;
        if (!Storage::disk('public')->exists('certificados/'.$certificado->nombre_certificado)) {
            Log::error('Certificado correspondiente a inscripción #'.$inscripcion->id_inscripcion.' no encontrado.');
            abort(500);
        } else {
            $destinatario = $inscripcion->perfil->email;
            Mail::to($destinatario)
                ->queue(new EnvioCertificado($campos['remitente'], $campos['asunto'], $campos['cuerpo_mail'], $certificado->nombre_certificado));
            $certificado->email_enviado = $destinatario;
            $certificado->save();
        }
    }
}
