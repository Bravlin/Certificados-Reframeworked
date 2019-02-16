<?php

namespace App\Http\Controllers;

use App\Inscripcion;
use Illuminate\Http\Request;
use App\Ayudas\ValidadorMail;
use App\Mail\EnvioCertificado;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MailController extends Controller
{
    private function validarEnvioCertificado(Request $request)
    {
        $campos = $request->validate([
            'remitente' => 'required',
            'asunto' => 'required',
            'cuerpo_mail' => 'required'
        ]);
        return ValidadorMail::superValidateEmail($campos['remitente']) ? $campos : false;
    }

    public function envioCertificadoIndividual(Request $request, Inscripcion $inscripcion)
    {
        $campos = $this->validarEnvioCertificado($request);
        if ($campos === false)
            abort(400);
        else {
            $certificado = $inscripcion->certificado;
            if (!Storage::disk('public')->exists('certificados/'.$certificado->nombre_certificado)) {
                Log::error('Certificado correspondiente a inscripción #'.$inscripcion->id_inscripcion.' no encontrado.');
                abort(500);
            } else {
                $rutaCertificado = public_path().'/storage/certificados/'.$certificado->nombre_certificado;
                $destinatario = $inscripcion->perfil->email;
                Mail::to($destinatario)
                    ->queue(new EnvioCertificado($campos['remitente'], $campos['asunto'], $campos['cuerpo_mail'], $rutaCertificado));
                $certificado->email_enviado = $destinatario;
                $certificado->save();
            }
        }
    }
}
