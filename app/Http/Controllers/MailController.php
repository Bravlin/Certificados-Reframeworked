<?php

namespace App\Http\Controllers;

use App\Evento;
use App\Inscripcion;
use Illuminate\Http\Request;
use App\Mail\EnvioCertificado;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\HttpException;

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

    private function enviarCertificado($campos, Inscripcion $inscripcion)
    {
        $certificado = $inscripcion->certificado;
        if (!Storage::disk('public')->exists('certificados/'.$certificado->nombre_certificado)) {
            Log::error('Certificado correspondiente a inscripción #'.$inscripcion->id_inscripcion.' no encontrado.');
            throw new HttpException(500);
        } else {
            $destinatario = $inscripcion->email;
            $now = Carbon::now()->addSeconds(5);
            Mail::to($destinatario)
                ->later($now, new EnvioCertificado($campos['remitente'], $campos['asunto'], $campos['cuerpo_mail'], $certificado->nombre_certificado));
            Log::info('Mail a inscripción #'.$inscripcion->id_inscripcion.' correctamente encolado.');
            $certificado->email_enviado = $destinatario;
            $certificado->save();
        }
    }

    public function envioCertificadoIndividual(Request $request, Inscripcion $inscripcion)
    {
        $campos = $this->validarEnvioCertificado($request);
        $this->enviarCertificado($campos, $inscripcion);
    }

    public function envioCertificadosMasivo(Request $request, Evento $evento)
    {
        $campos = $this->validarEnvioCertificado($request);
        foreach ($evento->inscripcionesAsistentes() as $inscripcion) {
            try {
                $this->enviarCertificado($campos, $inscripcion);
            } catch (HttpException $e) {
                Log::info('Envío de certificado correspondiente a inscripción #'.$inscripcion->id_inscripcion.' omitido.');
            }
        }
    }
}
