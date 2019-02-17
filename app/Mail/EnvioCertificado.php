<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnvioCertificado extends Mailable
{
    use Queueable, SerializesModels;

    private $nombreCertificado;
    private $remitente;
    private $asunto;

    public $cuerpo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($remitente, $asunto, $cuerpo, $nombreCertificado)
    {
        $this->remitente = $remitente;
        $this->asunto = $asunto;
        $this->cuerpo = $cuerpo;
        $this->nombreCertificado = $nombreCertificado;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->remitente)
            ->markdown('emails.enviar-certificado')
            ->attachFromStorageDisk('public', 'certificados/'.$this->nombreCertificado)
            ->subject($this->asunto);
    }
}
